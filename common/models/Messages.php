<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property integer $author
 * @property integer $recipient
 * @property string $message
 * @property integer $date
 *
 * @property User $recipient0
 * @property User $author0
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author', 'recipient', 'message'], 'required'],
            [['author', 'recipient', 'created_at', 'updated_at'], 'integer'],
            [['message'], 'string'],
            [['recipient'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recipient' => 'id']],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author' => 'id']],
        ];
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
                'updatedByAttribute' => 'author',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author' => 'Author',
            'recipient' => 'Recipient',
            'message' => 'Message',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipient()
    {
        return $this->hasOne(User::className(), ['id' => 'recipient']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllRecipients($uid = 0)
    {
        if ($uid == 0 || true) {
            $uid = Yii::$app->user->id;
        }

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM messages WHERE ((author=:uid) OR (recipient=:uid)) GROUP BY author, recipient',
            [':uid' => $uid]
        )->queryAll();

        $items = array();
        foreach ($list as $item) {
            if ($item['author'] == $uid) {
                $user = User::findOne(['id' => $item['recipient']]);
            } else {
                $user = User::findOne(['id' => $item['author']]);
            }
            if (isset($user->id)) {
                $items[$user->id] = $user;
            }
        }
        return $items;

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThread($id)
    {

        $uid = Yii::$app->user->id;

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM messages WHERE ((author=:uid) OR (recipient=:uid)) ORDER BY updated_at DESC',
            [':uid' => $uid]
        )->queryAll();

        $items = array();
        foreach ($list as $item) {
            $user = User::findOne(['id' => $item['author']]);
            if (isset($user->id)) {
                $item['user'] = $user;
                $items[] = $item;
            }
        }
        return $items;

    }


}
