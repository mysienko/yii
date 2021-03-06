<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\helpers\Image;
use yz\shoppingcart\CartPositionProviderInterface;
use yii\web\UploadedFile;

/**
 * This is the base model class for table "products".
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $description
 * @property string $image
 * @property string $price
 * @property string $currency
 * @property string $map
 * @property integer $created
 * @property integer $updated
 * @property integer $author
 * @property integer $editor
 * @property integer $lock
 */
class Products extends \yii\db\ActiveRecord implements CartPositionProviderInterface
{
    use \yz\shoppingcart\CartPositionTrait;
    public $image;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body', 'description', 'price'], 'required'],
            [['body'], 'string'],
            [['price', 'catalog'], 'number'],
            [['created', 'updated', 'author', 'editor', 'lock'], 'integer'],
            [['title', 'description', 'filename', 'map'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 10],
            [['lock'], 'default', 'value' => '0'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'body' => 'Описание',
            'description' => 'Краткое описание',
            'filename' => 'Фото',
            'price' => 'Цена',
            'currency' => 'Валюта',
            'catalog' => 'Каталог',
            'map' => 'Местонахождение',
            'updated' => 'Обновлено',
            'author' => 'Автор',
            'editor' => 'Редактор',
            'lock' => 'Lock',
        ];
    }

/**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'author',
                'updatedByAttribute' => 'editor',
            ],
        ];
    }

    /**
     * fetch stored image file name with complete path
     * @return string
     */
    public function getImageFile()
    {
        return isset($this->filename) ? Yii::getAlias('@webroot') . '/uploads/files/products/' . $this->filename : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl()
    {
        // return a default image placeholder if your source avatar is not found
        $file = isset($this->filename) ? $this->filename : 'default.jpg';
        return '/uploads/files/products/' . $file;
    }

    /**
     * Process upload of image
     *
     * @return mixed the uploaded image instance
     */
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'image');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        $this->filename = $image->name;
        $ext = end((explode(".", $image->name)));

        // generate a unique file name
        // $this->avatar = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }

    /**
     * Process deletion of image
     *
     * @return boolean the status of deletion
     */
    public function deleteImage() {
        $file = $this->getImageFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->filename = null;

        return true;
    }

    public function thumb($width = null, $height = null, $crop = true)
    {
        if($this->filename && ($width || $height)){
            return Image::thumb($this->getImageUrl(), $width, $height, $crop);
        }
        return Image::thumb('/upload/no-foto.jpg', $width, $height, $crop);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCartPosition($params = [])
    {
        return \Yii::createObject([
            'class' => 'common\models\ProductCartPosition',
            'id' => $this->id,
        ]);
    }

    public function getCost()
    {
       return $this->price;
    }

}
