<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="products-form">

    <?php  $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Title']) ?>

    <?= $form->field($model, 'body')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'basic',
            'clientOptions' => [
                'filebrowserImageUploadUrl' => '/files/upload',
            ],
    ]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <label class="control-label" for="stream-image">Фото</label>
    <?php

    if ($model->image) {
        echo Html::img($model->thumb(100,100, true), [
            'class'=>'img-thumbnail',
        ]);
    }

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
    
    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'placeholder' => 'Price']) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true, 'placeholder' => 'Currency']) ?>

    <?php
    /*
       $form->field($model, 'catalog')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \app\models\Catalog::getHierarchy(),
        'showToggleAll' => false,
        'options' => ['placeholder' => 'Выберите', 'multiple' => false],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Выберите каталог:');
    */
    ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
