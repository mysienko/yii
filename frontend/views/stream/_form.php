<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(
        ['style' => 'display:none']
    ); ?>

    <?= $form->field($model, 'title')->textInput(
        ['maxlength' => TRUE, 'placeholder' => 'Title']
    ) ?>

    <div class="form-group">
        <label class="control-label">Начало</label>
    <?php
    echo DateTimePicker::widget([
        'name' => 'datetime_stream',
        'model' => $model,
        'attribute' => 'datetime',
        'options' => [
                'placeholder' => ''
        ],
        'convertFormat' => true,
        'pluginOptions' => [
            'autoclose'=>true,
            // 'format' => 'dd-MM-yy hh:i',
            'todayBtn' => true,
            'todayHighlight' => true
        ]
    ]);
    ?>
    </div>

    <label class="control-label" for="stream-image">Фото</label>
    <?php
    $title = isset($model->file) && !empty($model->file) ? $model->file : 'Фото';
    echo Html::img($model->getImageUrl(), [
        'class' => 'img-thumbnail',
        'alt' => $title,
        'title' => $title
    ]);
    ?>

    <?php
    echo $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'allowedFileExtensions' => ['jpg', 'gif', 'png'],
            'showPreview' => false,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false
        ]])->label(false);
    ?>

    <?php $this->registerJsFile('/js/bootstrap-tagsinput.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <?php $this->registerCssFile('/css/bootstrap-tagsinput.css'); ?>
    <?php $this->registerJsFile('/js/typeahead.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
    <?php $this->registerCssFile('/css/typeahead.css'); ?>
    <?php $this->registerJsFile('/js/tagsinput-custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>


    <?= $form->field($model, 'tags')->textInput(
        ['id' => 'tags-input', 'maxlength' => TRUE, 'data-role' => 'tagsinput']
    ) ?>

    <?= $form->field($model, 'body')->widget(
        CKEditor::className(),
        [
            'options' => ['rows' => 6],
            'preset' => 'basic',
            'clientOptions' => [
                'filebrowserImageUploadUrl' => '/files/upload',
            ],
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Сохранить' : 'Сохранить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
