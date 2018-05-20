<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(
        ['style' => 'display:none']
    ); ?>

    <?= $form->field($model, 'title')->textInput(
        ['maxlength' => TRUE, 'placeholder' => 'Title']
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
