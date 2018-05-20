<?php

namespace frontend\controllers;

use Yii;
use common\models\Stream;
use common\models\StreamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

/**
 * StreamController implements the CRUD actions for Stream model.
 */
class StreamController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Stream models.
     * @return mixed
     */
    public function actionIndex($id = 0)
    {
        $params = Yii::$app->request->queryParams;
        if (isset($id) && $id > 0) {
            $params['StreamSearch']['author'] = $id;
        }

        $model = Yii::$app->user->identity;
        $searchModel = new StreamSearch();
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'user' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single Stream model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stream model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stream();

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->image = $image->name;
                $out_dir = '/uploads/files/streams/';
                $out_file_name = 'stream_' . md5(time() + 4) . '.' . $image->extension;
                $out_file = $out_dir . $out_file_name;
                BaseFileHelper::createDirectory(Yii::getAlias("@webroot") . $out_dir);
                $model->file = $out_file_name;
            }
            $model->datetime = date('Y-m-d h:i:s', strtotime($model->datetime));
            if ($model->save()) {
                if ($image) {
                    $image->saveAs(Yii::getAlias('@webroot') . $out_file);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stream model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->datetime = date('Y-m-d h:i:s', strtotime($model->datetime));

            $image = UploadedFile::getInstance($model, 'image');
            if ($image) {
                $model->image = $image->name;
                $out_dir = '/uploads/files/streams/';
                $out_file_name = 'stream_' . md5(time() + 4) . '.' . $image->extension;
                $out_file = $out_dir . $out_file_name;
                BaseFileHelper::createDirectory(Yii::getAlias("@webroot") . $out_dir);
                $model->file = $out_file_name;
            }

            $model->save();
            if ($image) {
                $image->saveAs(Yii::getAlias('@webroot') . $out_file);
            }

            \Yii::$app->session->setFlash('success', \Yii::t('post', 'Your post has been updated'));
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Stream model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        if (!$model->deleteImage()) {
            Yii::$app->session->setFlash('error', 'Error deleting image');
        }
        return $this->redirect(['index']);
    }


    /**
     * Finds the Stream model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stream the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stream::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
