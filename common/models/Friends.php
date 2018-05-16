<?php

namespace common\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "friends".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $fuid
 * @property integer $status
 * @property integer $date
 */
class Friends extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'fuid', 'status', 'date'], 'required'],
            [['uid', 'fuid', 'status', 'date'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Пользователь 1',
            'fuid' => 'Пользователь 2',
            'status' => 'Статус',
            'date' => 'Дата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriends($type = 'all', $uid = 0)
    {
        if ($uid == 0 || true) {
            $uid = Yii::$app->user->id;
        }

        $status = 1;

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM friends WHERE ((uid=:uid) OR (fuid=:uid)) AND status = :status',
            [':uid' => $uid, ':status' => $status]
        )->queryAll();

        $items = array();
        foreach ($list as $item) {
            if ($item['uid'] == $uid) {
                $user = User::findOne(['id' => $item['fuid']]);
            } else {
                $user = User::findOne(['id' => $item['uid']]);
            }
            if (isset($user->id)) {
                if ($type == 'online') {
                    if ( (time() - (20 *60) ) > $user->last_visit_at) {
                        break;
                    }
                }
                $items[] = $user;
            }
        }
        return $items;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequests($uid = 0)
    {
        if ($uid == 0 || true) {
            $uid = Yii::$app->user->id;
        }

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM friends WHERE (fuid=:uid) AND status = 0',
            [':uid' => $uid]
        )->queryAll();

        $items = array();
        foreach ($list as $item) {
            if ($item['uid'] == $uid) {
                $user = User::findOne(['id' => $item['fuid']]);
            } else {
                $user = User::findOne(['id' => $item['uid']]);
            }
            if (isset($user->id)) {
                $items[] = $user;
            }
        }
        return $items;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriend()
    {
        if (Yii::$app->user->id == $this->uid) {
            return $this->hasOne(User::className(), ['id' => 'fuid']);
        }
        if (Yii::$app->user->id == $this->fuid) {
            return $this->hasOne(User::className(), ['id' => 'uid']);
        }

        return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function checkFriend($friend_uid, $uid = 0)
    {
        if ($uid == 0 || TRUE) {
            $uid = Yii::$app->user->id;
        }
        $result = Yii::$app->db->createCommand(
            'SELECT id FROM friends WHERE ((uid=:uid AND fuid=:fuid) OR (uid=:fuid AND fuid=:uid))',
            [':uid' => $uid, 'fuid' => $friend_uid]
        )->execute();

        if (@$result && $result > 0) {
            return true;
        }

        return false;
    }


}
