<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('/js/jquery-ui.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('/css/jquery-ui.css');

$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

$slider = '$( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 100000,
                slide: function( event, ui ) {
                    $("#productssearch-costmin").val("" + ui.values[ 0 ]);
                    $("#productssearch-costmax").val("" + ui.values[ 1 ]);
                },
                create: function(event, ui){
                    $(this).slider("values",[ $("#productssearch-costmin").val(), $("#productssearch-costmax").val() ]);
                }
            });
            ';

$this->registerJs($slider);
?>

<div id="goods" class="section section_full">
    <div class="content">
        <div class="clearfix">
            <div class="goods_left_side">
                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                    'fieldConfig' => [
                        'options' => [
                            'tag' => false,
                        ],
                    ],
                    'options' => [
                        'class' => 'store_filter_form'
                    ]
                ]); ?>
                <h4>Фильтр</h4>
                <div class="goods_sections">
                    <h6>Разделы</h6>
                    <a href="#" class="accardion_btn">Разделы</a>
                    <ul class="goods_sec_list">
                    </ul>
                </div>
                <div class="goods_price">
                    <h6>Цена</h6>
                    <a href="#" class="accardion_btn">Цена</a>
                    <div class="range_slider">
                        <div id="slider-range"></div>
                        <div class="clearfix"></div>
                        <p class="_amount">
                            <?= $form->field($searchModel, 'costmin', ['template' => "{input}",'options' => ['class' => 'search_amount'], 'inputOptions' => ['readonly' => 'readonly', 'style' => 'border:none;']])->label(false) ?>
                        </p>
                        <p class="amount_">
                            <?= $form->field($searchModel, 'costmax', ['template' => "{input}", 'options' => ['class' => 'search_amount'], 'inputOptions' => ['readonly' => 'readonly', 'style' => 'border:none;']])->label(false) ?>
                        </p>
                    </div>
                    <?= Html::submitButton(Yii::t('app', 'Отобрать'), ['name' => 'cost', 'class' => 'btn']);?>
                </div>
                <div class="goods_sorting">
                    <h6>Сортировка</h6>
                    <a href="#" class="accardion_btn">Сортировка</a>
                    <div class="sorting_block">
                        <input id="checkbox1" type="checkbox" name="checkbox1">
                        <label for="checkbox1">
                            <span></span>Популярное
                        </label>
                        <input id="checkbox2" type="checkbox" name="checkbox2">
                        <label for="checkbox2">
                            <span></span>Новое
                        </label>
                        <input id="checkbox3" type="checkbox" name="checkbox3">
                        <label for="checkbox3">
                            <span></span>Со скидкой
                        </label>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="goods_right_side">
                <div class="search_goods">
                    <?php $form = ActiveForm::begin([
                        'action' => ['index'],
                        'method' => 'get',
                        'options' => [
                            'class' => 'auto_filter_form'
                        ]
                    ]); ?>

                    <?= $form->field($searchModel, 'title', ['options' => ['class' => 'search_text'], 'inputOptions' => ['placeholder' => 'Поиск по товарам', 'class' => 'form-control', 'autofocus' => 'autofocus']])->label(false) ?>

                    <?php ActiveForm::end(); ?>
                </div>
                <h2>Товары</h2>
                <ul class="goods_list clearfix">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'options' => [
                            'tag' => 'ul',
                            'class' => 'goods_list clearfix'
                        ],
                        'itemOptions' => [
                            'class' => 'row-news',
                            'tag' => 'li'
                        ],
                        'layout' => "{items}\n{pager}",
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('list', ['model' => $model, 'key' => $key, 'index' => $index, 'widget' => $widget, 'view' => $this]);
                        },
                    ]) ?>
                </ul>
            </div>
        </div>
    </div>
</div>

