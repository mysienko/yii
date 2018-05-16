<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;
use app\helpers\Image;
use yz\shoppingcart\CartPositionProviderInterface;

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
    use \mootensai\relation\RelationTrait;
    use \yz\shoppingcart\CartPositionTrait;
    public $file;
    public $del_img;

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
            [['title', 'description', 'image', 'map'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 10],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
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
            'image' => 'Фото',
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
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductsQuery(get_called_class());
    }
    
    public function thumb($width = null, $height = null, $crop = true)
    {
        if($this->image && ($width || $height)){
            return Image::thumb('/upload/products/'.$this->image, $width, $height, $crop);
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
            'class' => 'app\models\ProductCartPosition',
            'id' => $this->id,
        ]);
    }

    public function getCost()
    {
       return $this->price;
    }

}
