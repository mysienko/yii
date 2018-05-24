<?php

namespace frontend\controllers;

use Yii;
use common\models\Messages;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


/**
 * MessagesController implements the CRUD actions for Messages model.
 */
class MessagesController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Messages models.
     *
     * @return mixed
     */
    public function actionIndex($id = 0)
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/index']);
        }

        $model = new Messages();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->recipient]);
        }

        $uid = Yii::$app->user->id;
        $recipients = Messages::getAllRecipients();

        if ($id == 0) {
            if (count($recipients)) {
                $current_recipient = $recipients;
                $current_recipient = array_shift($current_recipient);
                $id = $current_recipient->id;
            } else {
                Yii::$app->session->setFlash('error', 'У Вас нет сообщений.');
                return $this->redirect(['/user/profile/show', 'id' => $uid]);
            }
        } else {
            $current_recipient = User::findOne(['id' => $id]);;
        }

        $messages = Messages::getThread($id);


        return $this->render(
            'index',
            [
                'recipients' => $recipients,
                'messages' => $messages,
                'user' => Yii::$app->user->identity,
                'recipient_id' => $id,
                'model' => $model,
                'current_recipient' => $current_recipient
            ]
        );

        $messagesProvider = new ActiveDataProvider(
            [
                'query' => Messages::find()->orderBy('created_at'),
                'pagination' => false,
            ]
        );
        $messagesModels = $messagesProvider->getModels();
        $recipients = [];
        $messages = [];
        foreach ($messagesModels as $messagesModel) {
            if ($messagesModel->author == $uid && $messagesModel->recipient != $uid) {
                $recipients[$messagesModel->recipient] = $messagesModel->recipient;
                if ($id == 0) {
                    $id = $messagesModel->recipient;
                }
            }
            if ($messagesModel->author != $uid && $messagesModel->recipient == $uid) {
                $recipients[$messagesModel->author] = $messagesModel->author;
                if ($id == 0) {
                    $id = $messagesModel->author;
                }
            }
            if ($id == $messagesModel->author || $id == $messagesModel->recipient) {
                $messages[$messagesModel->id] = $messagesModel;
            }
        }

        foreach ($recipients as $recipient) {
            $modelUser = \common\models\User::findOne($recipient);
            $recipients[$recipient] = $modelUser;
        }

        return $this->render(
            'index',
            [
                'recipients' => $recipients,
                'messages' => $messages,
                'user' => Yii::$app->user->identity,
                'recipient_id' => $id,
                'model' => $model,
            ]
        );
    }

    /**
     * Finds the Messages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Messages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(
                'The requested page does not exist.'
            );
        }
    }
}
