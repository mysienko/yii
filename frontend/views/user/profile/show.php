<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\Profile $profile
 */

$this->title = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$this->params['breadcrumbs'][] = $this->title;

$model = $profile;
?>

<div id="profile" class="section section_full">
  <div class="content">
    <div class="clearfix">
      <div class="section_left">
        <div class="profile_top">
          <div class="profile_main">
            <div class="profile_image">
                <?php // echo Html::img($model->thumb(100,100, true), ['class'=>'img-thumbnail']); ?>
            </div>
            <div class="profile_info">
              <div class="profile_name"><?= $model->user->username ?> <?= $model->name ?></div>
              <div class="online_offline offline">не в сети</div>
              <div class="profile_btns clearfix">
                  <?php if ($model->user->id == Yii::$app->user->id) : ?>
                      <?= Html::a('Редактировать', ['/user/settings/profile'], ['class' => 'red']) ?>
                  <?php else : ?>
                      <?= Html::a('Добавить в друзья', ['/friends/add', 'id' => $model->id] , ['class' => 'add_to_friends']) ?>
                    <a href="#">Видеозвонок</a>
                      <?= Html::a('Написать сообщение', ['/messages', 'id' => $model->id] , ['class' => 'red']) ?>
                  <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="profile_info_about clearfix">
            <div class="profile_about">
              <span>О себе</span>
              <p>Интересной особенностью автобиографии
                как жанра является то, что у одного и того
                же человека может быть сколько угодно
                описаний его жизни. Причем жизнь тоже
                остается одной, и все события, которые
                в ней происходили, правдивы.</p>
            </div>
            <div class="profile_contacts">
              <span>Контакты</span>
              <div>
                <p>тел. +7 999 252 25 25</p>
                <p>почта: nefr231@unesis.net</p>
                <p>скайп: nefr2244</p>
                <p>icq: 215125121</p>
              </div>
            </div>
          </div>
        </div>
        <div class="profile">
          <ul class="profile_nav clearfix">
            <li>
                <?= Html::a('Все друзья  <span>(22)</span>', ['/friends', 'id' => $model->user->id], ['class' => 'active']) ?>
            </li>
            <li>
                <?= Html::a('Трансляции <span>(7)</span>', ['/stream', 'id' => $model->user->id], ['class' => '']) ?>
            </li>
            <li>
              <a href="#">Видео <span>(97)</span></a>
            </li>
            <li>
                <?= Html::a('Фото <span>(142)</span>', ['/photo', 'id' => $model->user->id], ['class' => '']) ?>
            </li>
            <li>
              <a href="#">Товары <span>(3)</span></a>
            </li>
          </ul>

          <div class="friends">
            <ul class="friends_list clearfix">
              <li class="friend_item clearfix">
                <div class="friend_left">
                  <div class="friend_image">
                    <img src="images/user_avatar.png" alt="">
                  </div>
                  <div class="friend_info">
                    <span class="online">Online</span>
                    <a href="#" class="name">Владимир Мохнов</a>
                    <div class="live">ИДЕТ ТРАНСЛЯЦИЯ</div>
                  </div>
                </div>
                <ul class="friend_right">
                  <li>
                    <a href="#" class="mess_btn">Написать сообщение</a>
                  </li>
                  <li>
                    <a href="#" class="broadcasts_btn">Трансляции</a>
                  </li>
                  <li>
                    <a href="#" class="remove_btn">Убрать из друзей</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
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

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <?= Html::img($profile->getAvatarUrl(230), [
                    'class' => 'img-rounded img-responsive',
                    'alt' => $profile->user->username,
                ]) ?>
            </div>
            <div class="col-sm-6 col-md-8">
                <h4><?= $this->title ?></h4>
                <ul style="padding: 0; list-style: none outside none;">
                    <?php if (!empty($profile->location)): ?>
                        <li>
                            <i class="glyphicon glyphicon-map-marker text-muted"></i> <?= Html::encode($profile->location) ?>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($profile->website)): ?>
                        <li>
                            <i class="glyphicon glyphicon-globe text-muted"></i> <?= Html::a(Html::encode($profile->website), Html::encode($profile->website)) ?>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($profile->public_email)): ?>
                        <li>
                            <i class="glyphicon glyphicon-envelope text-muted"></i> <?= Html::a(Html::encode($profile->public_email), 'mailto:' . Html::encode($profile->public_email)) ?>
                        </li>
                    <?php endif; ?>
                    <li>
                        <i class="glyphicon glyphicon-time text-muted"></i> <?= Yii::t('user', 'Joined on {0, date}', $profile->user->created_at) ?>
                    </li>
                </ul>
                <?php if (!empty($profile->bio)): ?>
                    <p><?= Html::encode($profile->bio) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
