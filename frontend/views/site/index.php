<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\StringHelper;

$this->title = 'Unesis';
?>


<div id="main" class="section">
    <div class="content">
        <div class="online_tv">
            <div class="online_tv_top clearfix">
                <h3>Образование</h3>
                <ul class="online_tv_list">
                    <li>
                        <a href="#">Математика</a>
                    </li>
                    <li>
                        <a href="#">История</a>
                    </li>
                    <li>
                        <a href="#">МГУ им.Баумана</a>
                    </li>
                    <li>
                        <a href="#">Медицина</a>
                    </li>
                    <li>
                        <a href="#">Школа</a>
                    </li>
                    <li>
                        <a href="#">ВУЗ</a>
                    </li>
                    <li>
                        <a href="#" class="online_more">...</a>
                    </li>
                </ul>
                <select name="" id="">
                    <option value="">Skoda</option>
                    <option value="">Skoda</option>
                    <option value="">Skoda</option>
                    <option value="">Skoda</option>
                    <option value="">Skoda</option>
                    <option value="">Skoda</option>
                    <option value="">Skoda</option>
                    <option value="">Skoda</option>
                </select>
            </div>
            <div class="online_tv_slide slide1 owl-carousel owl-theme">
                <?php
                foreach ($streams as $model) {
                    $tags = explode(',', @$model->tags);
                    echo '
                        <div class="item">
                            <a href="' . Url::to(['/stream/view', 'id' => $model->id]) . '">
                                <span class="image">
                                    ' . Html::img($model->thumb(357, 256)) . ' 
                                    <span class="rating clearfix">
                                        <img src="images/star_active.png" alt="">
                                        <img src="images/star_active.png" alt="">
                                        <img src="images/star_active.png" alt="">
                                        <img src="images/star_active.png" alt="">
                                        <img src="images/star_passive.png" alt="">
                                    </span>
                                </span>
                                <span class="online_item_bottom clearfix">
                                    <span class="name">' . $model->authorModel->name . '</span>
                                    <span class="type">' . $tags[0] . '</span>
                                </span>
                            </a>
                        </div>';
                        }
                 ?>
            </div>
        </div>
    </div>
</div>
<div id="main_goods" class="section section_full">
    <div class="content">
        <div class="section_top">
            <h2 class="goods_title">Товары</h2>
        </div>
        <div class="clearfix">
            <div class="section_left">
                <ul class="goods_list clearfix">
                    <?php
                    foreach ($products as $model) {
                        echo '
                        <li>
                            <div class="image">
                                <a href="' . Url::to(['/products/view', 'id' => $model->id]) . '">' . Html::img($model->thumb(216,159, true)) . '</a>
                            </div>
                            <div class="goods_name">' . Html::a($model->title, ['products/view', 'id' => $model->id], ['class' => '']) . '</div>
                            <div class="goods_price">' . $model->price . ' ' . $model->currency .'</div>
                            <a href="'.Yii::$app->urlManager->createUrl(['products/buy', 'id' => $model->id,]).'" class="to_basket_btn">В корзину</a>
                        </li>
                      ';
                    }
                    ?>
                 </ul>
            </div>
            <div class="section_right">
                <?= \common\widgets\Ads::widget() ?>
            </div>
        </div>
    </div>
</div>
<div id="main_news" class="section section_full">
    <div class="content">
        <div class="section_top">
            <h2 class="news_title">Новости</h2>
        </div>
        <div class="main_news_slide owl-carousel owl-theme">
            <?php
            foreach ($news as $model) {
                echo '
               <div class="item">
                <a href="' . Url::to(['/news/view', 'id' => $model->id]) . '" class="min_news_item">
                    <span class="news_image">
                        ' . Html::img($model->thumb(127,null, true)) . '
                    </span>
                    <span class="news_text">
                        <h4>' . $model->title . '</h4>
                        <p>' . StringHelper::truncate(strip_tags($model->body), '300', '...', null, false) . '</p>
                    </span>
                </a>
              </div>
            ';
            }
            ?>
        </div>
    </div>
</div>
<div id="main_photos" class="section section_full">
    <div class="content">
        <div class="section_top">
            <h2 class="photo_title">Фотографии</h2>
        </div>
        <div class="clearfix">
            <div class="section_left">
                <div class="photos">
                    <ul class="photos_list clearfix">
                        <li>
                            <a href="#">
                                <img src="images/photo1.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/photo2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/photo3.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/photo2.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/photo3.jpg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="images/photo1.jpg" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section_right">
                <div class="event">
                    <div class="event_block">
                        <div class="user_name">
                            <span>Василий Домбровский</span>
                        </div>
                        <div class="date">15-16 августа 15:30</div>
                        <p>Конференция по новым компьютерным технологиям и защите компьютерных программ!</p>
                        <a href="#" class="connect_btn">Подключиться</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


