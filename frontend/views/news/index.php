<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

$this->title = 'Лента';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>

<div id="news" class="section">
    <div class="content">
        <div class="clearfix">
            <div class="section_left">
                <div class="news_top clearfix">
                    <h1>Лента</h1>
                    <div class="clearfix">

                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => [
                                'class' => 'auto_filter_form'
                            ]
                        ]); ?>

                        <?= $form->field($searchModel, 'title', ['options' => ['class' => 'search_interesting'], 'inputOptions' => ['placeholder' => 'Что вам интересно?', 'class' => 'form-control', 'autofocus' => 'autofocus']])->label(false) ?>

                        <?= $form->field($searchModel, 'orderby', ['options' => ['class' => 'news_sort']])->dropDownList([
                            'desc' => 'Новые',
                            'asc' => 'Старые',
                        ])->label('Сортировать:') ?>

                        <?php ActiveForm::end(); ?>

                    </div>
                    <div class="clearfix unesis_actions">
                        <?= Html::a('Разместить пост', ['/news/create'], ['role' => 'button', 'class' => 'btn btn-primary']) ?>
                    </div>
                </div>


                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'row-news'],
                    'layout' => "{items}\n{pager}",
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('list', ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this]);
                    },
                ]) ?>

            </div>
            <div class="section_right">
                <?= \common\widgets\LastStreams::widget() ?>
            </div>
        </div>
    </div>
</div>
