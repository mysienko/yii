<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM news  ORDER BY created_at LIMIT 8'
        )->queryAll();
        $news = array();
        foreach ($list as $item) {
            $model = \common\models\News::findOne(['id' => $item['id']]);
            $news[] = $model;
        }

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM streams  ORDER BY created_at LIMIT 9'
        )->queryAll();
        $streams = array();
        foreach ($list as $item) {
            $model = \common\models\Stream::findOne(['id' => $item['id']]);
            $streams[] = $model;
        }

        $list = Yii::$app->db->createCommand(
            'SELECT * FROM products ORDER BY created LIMIT 6'
        )->queryAll();
        $products = array();
        foreach ($list as $item) {
            $model = \common\models\Products::findOne(['id' => $item['id']]);
            $products[] = $model;
        }

        $photos = array();

        return $this->render(
            'index',
            [
                'news' => $news,
                'products' => $products,
                'streams' => $streams,
                'photos' => $photos,
            ]
        );

    }


}
