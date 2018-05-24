<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use common\helpers\Image;

/**
 * This is the base model class for table "news".
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
class News extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['created_at', 'updated_at', 'author', 'editor'], 'integer'],
            [['body'], 'string'],
            [['title', 'description'], 'string', 'max' => 255],
            [['lock'], 'default', 'value' => '0'],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
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
            'body' => 'Содержимое',
            'description' => 'Описание',
            'updated' => 'Дата изменения',
            'author' => 'Автор',
            'editor' => 'Редактор',
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

    public function getFirstImage() {
        preg_match('/<img(.*)src(.*)=(.*)"(.*)"/U', $this->body, $regexResult);
        $src = array_pop($regexResult);
        return $src;
    }

    public function thumb($width = null, $height = null, $crop = true)
    {
        if($this->getFirstImage() && ($width || $height)){
            return Image::thumb($this->getFirstImage(), $width, $height, $crop);
        }
        return Image::thumb('/upload/no-foto.jpg', $width, $height, $crop);
    }

}
