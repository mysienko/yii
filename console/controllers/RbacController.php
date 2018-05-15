<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $fullAccessPerm = $auth->createPermission(Yii::$app->getModule('user')->administratorPermissionName);
        $fullAccessPerm->description = 'Полный доступ';
        $auth->add($fullAccessPerm);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $fullAccessPerm);

        $auth->assign($admin, 1);
    }
}