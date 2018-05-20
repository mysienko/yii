<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = $model->title;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="goods_item" class="section section_full">
    <div class="content">
        <div class="goods_item_block">
            <div class="goods_item clearfix">
                <div class="goods_item_img">
                    <?= Html::a(Html::img($model->thumb(200, 200)), ['products/view','id' => $model->id], ['class' => '']) ?>
                </div>
                <div class="goods_item_info">
                    <h2><?= $model->title ?></h2>
                    <div class="info_img">
                        <img src="/images/goods_item.jpg" alt="">
                    </div>
                    <div class="goods_item_description">
                        <span>Описание</span>
                        <div>
                            <?= $model->body ?>
                        </div>
                    </div>
                    <div class="goods_item_seller">
                        <span>Продавец</span>
                        <a href="<?= Url::to(['/user/profile/show', 'id' => Yii::$app->user->identity->id]) ?>" class="user_name">
                            <span class="image">
                                <?php echo Html::img(Yii::$app->user->identity->thumb(100, 100, true), ['class' => '']); ?>
                            </span>
                            <?= Yii::$app->user->identity->name; ?>
                        </a>
                        <a href="#">
                            <span class="image">
                                <img src="images/user_avatar.png" alt="">
                            </span>
                        </a>
                    </div>
                    <div class="goods_item_bottom clearfix">
                        <div class="item_price"><?= $model->price ?> <?= $model->currency ?></div>
                        <div class="item_add_basket">
							<a href="<?= Yii::$app->urlManager->createUrl(['products/buy','id' => $model->id,])?>" class = "add_to_basket_btn">
                                <?= Yii::t('app', 'Добавить в корзину') ?>
                            </a>
                            <div>
                                <span class="in_stock">В наличии</span>
                                <a href="<?= Url::to(['/bookmarks/add', 'id' => $model->id, 'type' => 'products']) ?>" class="favorite_btn">В избранное</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($model->author == Yii::$app->user->identity->id) {
                    echo Html::a('Редактировать', ['/products/update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    echo Html::a('Удалить', ['/products/delete', 'id' => $model->id], [
                        'class' => 'btn btn-primary',
                        'data' => [
                            'confirm' => 'Уверены, что хотите удалить?',
                            'method' => 'post',
                        ],
                    ]);
                }
                ?>
            </div>
            <div class="goods_item_reviwes" style="display: none;">
                <h3>Отзывы о товаре</h3>
                <div class="reviews">

                </div>
            </div>
        </div>
        <div class="other_goods">
            <h3>Другие товары продавца:</h3>
            <?= ListView::widget([
                'dataProvider' => $other,
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
        </div>
    </div>
</div>
