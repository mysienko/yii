<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class StreamController extends Controller
{


    /**
     * Displays .
     *
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index', [

        ]);
        
    }

}