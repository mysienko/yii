<?php

namespace frontend\controllers;

use Yii;
use common\models\Friends;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FriendsController  actions for Friends model.
 */
class FriendsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * Lists all Friends models.
     * @return mixed
     */
    public function actionIndex($uid = 0)
    {
        $friends = Friends::getFriends();
        $requests = Friends::getRequests();
        $online = Friends::getFriends('online');

        return $this->render('index', [
            'friends' => $friends,
            'requests' => $requests,
            'online' => $online
        ]);
    }

    /**
     * Lists all Friends models.
     * @return mixed
     */
    public function actionOnline()
    {
        $friends = Friends::getFriends();
        $requests = Friends::getRequests();
        $online = Friends::getFriends('online');

        return $this->render('online', [
            'friends' => $friends,
            'requests' => $requests,
            'online' => $online
        ]);
    }
    
    /**
     * Lists all Friends models.
     * @return mixed
     */
    public function actionRequest()
    {
        $friends = Friends::getFriends();
        $requests = Friends::getRequests();
        $online = Friends::getFriends('online');

        return $this->render('request', [
            'friends' => $friends,
            'requests' => $requests,
            'online' => $online
        ]);
    }
    
    /**
     * Finds the Friends model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Friends the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Friends::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * 
     * @return mixed
     */
    public function actionAdd($id)
    {
        // check exist relation
        if (Friends::checkFriend($id)) {
            Yii::$app->session->setFlash('error', 'Вы уже добавлены в друзья.');
        } else {
            $friend = new Friends();
            $friend->uid = Yii::$app->user->id;
            $friend->fuid = $id;
            $friend->status = 0;
            $friend->date = time();
            $friend->save();
            Yii::$app->session->setFlash('info', 'Запрос на добавление в друзья отправлен.');
        }
        return $this->redirect(['/friends']);
    }

    /**
     *
     * @return mixed
     */
    public function actionApprove($id)
    {
        $uid = Yii::$app->user->id;
        // check exist relation

        $relation = Friends::findOne(['uid' => $id, 'fuid' => $uid]);
        if ($relation) {
            $relation->status = 1;
            $relation->date = time();
            $relation->save();
            Yii::$app->session->setFlash('error', 'Запрос обработан.');

            return $this->redirect(['/friends']);
        }
        $relation = Friends::findOne(['uid' => $uid, 'fuid' => $id]);
        if ($relation) {
            $relation->status = 1;
            $relation->date = time();
            $relation->save();
            Yii::$app->session->setFlash('error', 'Запрос обработан.');

            return $this->redirect(['/friends']);
        }

        return $this->redirect(['/friends']);
    }

    /**
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        $uid = Yii::$app->user->id;
        // check exist relation
        if (Friends::checkFriend($id)) {
            $relation = Friends::findOne(['uid' => $id, 'fuid' => $uid]);
            if ($relation) {
                $relation->delete();
            }
            $relation = Friends::findOne(['uid' => $uid, 'fuid' => $id]);
            if ($relation) {
                $relation->delete();
            }
            Yii::$app->session->setFlash('error', 'Удалено.');
        } else {
            Yii::$app->session->setFlash('error', 'Вы уже добавлены в друзья.');
        }
        return $this->redirect(['/friends']);
    }

}
