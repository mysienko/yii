<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

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
 * @property \app\models\User $u
 */
class News extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

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
            [['lock'], 'mootensai\components\OptimisticLockValidator']
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
    public function getU()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'author']);
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
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\NewsQuery(get_called_class());
    }
}
