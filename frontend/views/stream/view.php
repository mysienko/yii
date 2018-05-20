<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Трансляции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->identity;

?>


<div id="news" class="section">
    <div class="content">
        <div class="clearfix">
            <div class="section_left">
                <div class="news_item">
                    <div class="news_user">
                        <div class="user_image">
                            <?php echo Html::img($user->thumb(100, 100, true), ['class' => '']); ?>
                        </div>
                        <div>
                            <a href="<?= Url::to(['/user/profile/show', 'id' => $user->id]) ?>"
                               class="user_name"><?= $user->name; ?></a>
                            <span class="date" style="display: none;"><?= date('d.m.Y H:i', $model->updated_at) ?></span>
                        </div>
                    </div>
                    <div class="hashtags clearfix">
                        <div class="date">Начало <?= date('d.m.Y в H:i', strtotime($model->datetime)); ?></div>
                        <?php
                        $tags = explode(',', @$model->tags);
                        foreach ($tags as $tag) {
                            echo ' <span class="type">' . $tag . '</span>';
                        }
                        ?>
                    </div>
                    <h4><?= $model->title ?></h4>
                    <?php echo Html::img($model->thumb(690, null, true), ['class' => '']); ?>
                    <?= $model->body ?>
                    <?php
                    if ($model->author == $user->id) {
                        echo Html::a('Редактировать', ['/stream/update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                        echo Html::a('Удалить', ['/stream/delete', 'id' => $model->id], [
                            'class' => 'btn btn-primary',
                            'data' => [
                                'confirm' => 'Уверены, что хотите удалить?',
                                'method' => 'post',
                            ],
                        ]);

                    }
                    ?>
                </div>
            </div>
            <div class="section_right">

            </div>
        </div>
    </div>
</div>

