<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;


class CartController extends Controller
{


    /**
     * Displays .
     *
     * @return string
     */
    public function actionIndex()
    {
        $positions = Yii::$app->cart->positions;

        if (Yii::$app->request->post('quantity')) {
            
            foreach (Yii::$app->request->post('quantity') as $qid => $value) {
              if (substr($qid,0,6) == 'simple') {
                  $type = 'simple';
                  $qid = substr($qid,6);
              }
              else
                  $type = 'simple';

              $md_id = md5(serialize([intval($qid), $type]));
              $md_id = intval($qid);
              $position = Yii::$app->cart->getPositionById($md_id);
              if ($position) {
                Yii::$app->cart->remove($position);
                Yii::$app->cart->put($position,$value);
              }
            }
            Yii::$app->session->setFlash('success', 'Корзина обновлена.');
            return $this->redirect(['/cart']); 
        }

        $total = \Yii::$app->cart->getCost();
        //$model = new Orders;

        /*if (!Yii::$app->user->isGuest) {
            $model->email = Yii::$app->user->identity->email;
            $model->phone = Yii::$app->user->identity->phone;
            $model->name = Yii::$app->user->identity->name;
        }*/

        return $this->render('cart',[
          'positions'=>$positions,
          'total'=>$total,
          //'model'=>$model
        ]);
        
    }

    public function actionDelete($id, $type = 'simple')
    {
        $md_id = md5(serialize([intval($id), $type]));
        $md_id = $id;
        $position = Yii::$app->cart->getPositionById($md_id);
        if ($position)
            Yii::$app->cart->remove($position);
            
        return $this->redirect(['/cart']); 
    }
    
}
