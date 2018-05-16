<?php

namespace common\components;


use yii\base\Behavior;
use yii\console\Controller;
use yii\behaviors\TimestampBehavior;
use common\models\User;

class LastVisitBehavior extends Behavior
{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),//вообще пока не используется
        ];
    }

    public function events()
    {
        return [
            Controller::EVENT_AFTER_ACTION => 'afterAction',
        ];
    }

    public function afterAction()
    {
        if (!\Yii::$app->user->isGuest) {
            $model = \Yii::$app->getUser()->getIdentity();
            $model->updateAttributes(['last_visit_at' => time()]);
        }

        return true;
    }
}