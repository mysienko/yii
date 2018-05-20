<?php
namespace frontend\controllers;

use Yii;
use common\models\Stream;
use common\models\StreamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 *
 */
class DataController extends Controller
{
    /**
     */
    public function actionTags()
    {
        $list = Yii::$app->db->createCommand('SELECT tags FROM streams')->queryAll();
        $items = array();
        foreach ($list as $item) {
            $tags = explode(',',$item['tags']);
            foreach ($tags as $tag) {
                $items[] = $tag;
            }
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $items;
    }

}
