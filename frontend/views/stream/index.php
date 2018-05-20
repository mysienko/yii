<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

$this->title = 'Трансляции';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="broadcasts" class="section section_full">
    <div class="content">
        <div class="clearfix">
            <div class="section_left">
                <div class="section_top clearfix">
                    <h2 class="broadcasts_title">Трансляции</h2>
                    <div class="broadcasts_btns">
                        <?= Html::a('Мои  <span></span>', ['/stream', 'id' => Yii::$app->user->identity->id], ['class' => 'active']) ?>
                        <?= Html::a('Друзья  <span></span>', ['/stream', 'id' => Yii::$app->user->identity->id, 'friends' => 'friends'], ['class' => '']) ?>
                    </div>
                    <div class="search_friends">
                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => [
                                'class' => 'auto_filter_form'
                            ]
                        ]); ?>
                        <?= $form->field($searchModel, 'title', ['options' => ['class' => 'search_interesting'], 'inputOptions' => ['placeholder' => 'Найти', 'class' => 'form-control', 'autofocus' => 'autofocus']])->label(false) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="broadcasts">

                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options'  => [
                            'class' => 'broadcasts_list clearfix',
                            'tag' => 'ul',
                        ],
                        'itemOptions' => [
                             'class' => 'broadcasts_item',
                            'tag' => 'li'
                        ],
                        'layout' => "{items}\n{pager}",
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('list', ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this]);
                        },
                    ]) ?>

                </div>
            </div>
            <div class="section_right">
                <?= \common\widgets\PopularVideo::widget() ?>
            </div>
        </div>
    </div>
</div>