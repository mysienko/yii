<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$user = Yii::$app->user->identity;
?>

<a href="<?= Url::to(['/stream/view', 'id' => $model->id]) ?>">
        <span class="image">
            <?php
            echo Html::img($model->getImageUrl(), [
                'class' => 'stream_img',
                'alt' => $model->title,
                'title' => $model->title
            ]);
            ?>
            <span class="rating clearfix">
                <img src="images/star_active.png" alt="">
                <img src="images/star_active.png" alt="">
                <img src="images/star_active.png" alt="">
                <img src="images/star_active.png" alt="">
                <img src="images/star_passive.png" alt="">
            </span>
        </span>
    <span class="online_item_bottom clearfix">
            <span class="name"><?= $model->authorModel->name ?></span>
            <span class="type">
                <?php
                $tags = explode(',', @$model->tags);
                if (count($tags)) {
                    echo $tags[0];
                }
                ?>
            </span>
        </span>
</a>










