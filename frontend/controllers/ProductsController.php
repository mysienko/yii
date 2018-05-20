<?php

namespace frontend\controllers;

use Yii;
use common\models\Products;
use common\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use yz\shoppingcart\ShoppingCart;
use common\models\ProductCartPosition;


/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'buy'],
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $searchModel = new ProductsSearch();
        $params = array(
            'ProductsSearch' => array(
                'author' => $model->author
            )
        );
        $dataProvider = $searchModel->search($params);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'other' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model = new Products;

        if ($model->load(Yii::$app->request->post())) {
            $image = $model->uploadImage();

            if ($model->save()) {
                if ($image !== false) {
                    $path = $model->getImageFile();
                    $image->saveAs($path);
                }
                return $this->redirect(['view', 'id'=>$model->id]);
            } else {
                // error in saving model
            }
        }
        return $this->render('create', [
            'model'=>$model,
        ]);

    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

          if ($model->load(Yii::$app->request->post())) {
          
            // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
            $image = UploadedFile::getInstance($model, 'file');
            if ($image) {
              // store the source file name
              $model->file = $image->name;
              $tmp = explode('.', $image->name);
              $ext = end($tmp);

              // generate a unique file name
              $model->image = 'products'.$id.".{$ext}";

              // the path to save file, you can set an uploadPath
              // in Yii::$app->params (as used in example below)
              $path = Yii::$app->params['uploadPath'] . 'products/' .  $model->image;
            }
            if($model->save()){
                if ($image) {
                  $image->saveAs($path);
                }
                return $this->redirect(['/products']);
            } else {
                return $this->render('update', [
                'model' => $model,
            ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
      
    }

    /**
     * Deletes an existing Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionBuy($id)
    {
        
        $model = Products::findOne($id);
            
        if ($model) {
            $cartPosition = new ProductCartPosition();
            $cartPosition->id = $model->id;
          
            $cartPosition->name = $model->title;

            \Yii::$app->cart->put($cartPosition, 1);

            return $this->redirect(['/cart']);
        }
        
        throw new NotFoundHttpException();
    }


}
