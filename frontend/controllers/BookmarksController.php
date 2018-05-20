<?php
/*
 */

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 *
 */
class BookmarksController extends Controller
{
    public function actionIndex($id = 0)
    {
        return $this->render('index', [
        ]);

    }
}
