<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Лента', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div id="news" class="section">
    <div class="section_left white">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
    <div class="section_right">
        <?= \common\widgets\Ads::widget() ?>
    </div>
</div>
