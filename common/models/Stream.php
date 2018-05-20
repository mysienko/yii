<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\helpers\Image;

/**
 * This is the base model class for table "streams".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $title
 * @property string $body
 * @property string $description
 * @property integer $created
 * @property integer $updated
 * @property integer $author
 * @property integer $editor
 *
 *
 */
class Stream extends \yii\db\ActiveRecord
{

    public $image;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['created_at', 'updated_at', 'author', 'editor', 'rating'], 'integer'],
            [['body'], 'string'],
            [['title', 'description', 'tags'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
            [['image', 'file', 'datetime'], 'safe'],
            [['image', 'file'], 'file', 'extensions'=>'jpg, gif, png'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'streams';
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
            'description' => 'Описание',
            'updated' => 'Дата изменения',
            'author' => 'Автор',
            'editor' => 'Редактор',
            'image' => 'Фото',
            'tags' => 'Хэштеги'
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorModel()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'author']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
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
        return isset($this->file) ? Yii::getAlias('@webroot') . '/uploads/files/streams/' . $this->file : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl()
    {
        // return a default image placeholder if your source file is not found
        $file = isset($this->file) ? $this->file : 'default.jpg';
        return '/uploads/files/streams/' . $file;
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
        $this->file = Yii::$app->security->generateRandomString().".{$ext}";

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
        $this->file = null;

        return true;
    }

    public function thumb($width = null, $height = null, $crop = true)
    {
        if($this->file && ($width || $height)){
            return Image::thumb($this->getImageUrl(), $width, $height, $crop);
        }
        return Image::thumb('/upload/no-foto.jpg', $width, $height, $crop);
    }
}
