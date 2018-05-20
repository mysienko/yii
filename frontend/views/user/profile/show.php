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
use common\models\Friends;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\Profile $profile
 */

$this->title = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$this->params['breadcrumbs'][] = $this->title;

$friends = \common\models\Friends::getFriends();
$products = $profile->getProducts();
$news= $profile->getNews();
$streams = $profile->getStreams();


?>

<div id="profile" class="section section_full">
  <div class="content">
    <div class="clearfix">
      <div class="section_left">
        <div class="profile_top">
          <div class="profile_main">
            <div class="profile_image">
                <?php
                   echo Html::img($profile->user->thumb(100,100, true), [
                       'class' => 'img-rounded img-responsive',
                       'alt' => $profile->user->username
                   ]);
                 ?>
            </div>
            <div class="profile_info">
              <div class="profile_name"><?= $profile->user->username ?> <?= $profile->name ?></div>
              <?php if ($profile->user->getStatusOnline()) : ?>
                <div class="online_offline online">в сети</div>
              <?php else: ?>
                <div class="online_offline offline">не в сети <?= $profile->user->getLastVisit() ?></div>
              <?php endif; ?>

                <?php if ($profile->user->id == Yii::$app->user->id) : ?>
                    <div class="profile_add">
                    <a href="#" class="profile_add_btn"><span>+</span>Добавить</a>
                    <ul class="add_more">
                        <li class="broadcasting_li">
                            <a href="/stream/create">Трансляция</a>
                        </li>
                        <li class="purchase_li">
                            <a href="/products/create">Товар</a>
                        </li>
                        <li class="news_li">
                            <a href="/news/create">Новость</a>
                        </li>
                        <li class="video_li">
                            <a href="/video/create">Видео</a>
                        </li>
                        <li class="photo_li">
                            <a href="/photo/create">Фото</a>
                        </li>
                        <li class="friends_li">
                            <a href="/friends">Друзья</a>
                        </li>
                    </ul>
                </div>
                    <?= Html::a('Редактировать', ['/user/settings/profile'], ['class' => 'edit_btn']) ?>
                <?php else : ?>
                <div class="profile_btns clearfix">
                      <?php
                          if (Friends::checkFriend($profile->user->id)) {
                              echo Html::a('Удалить из друзей', ['/friends/delete', 'id' => $profile->user->id] , ['class' => 'delete_friends']);
                          } else {
                              echo Html::a('Добавить в друзья', ['/friends/add', 'id' => $profile->user->id] , ['class' => 'add_to_friends']);
                          }
                      ?>
                      <?= Html::a('Написать сообщение', ['/messages', 'id' => $profile->user->id] , ['class' => 'red']) ?>
                </div>
                <?php endif; ?>

            </div>
          </div>
          <div class="profile_info_about clearfix">
            <div class="profile_about">
                <?php if (!empty($profile->bio)): ?>
                  <span>О себе</span>
                  <p><?= Html::encode($profile->bio) ?></p>
                <?php endif; ?>
            </div>
            <div class="profile_contacts">
              <span>Контакты</span>
              <div>
                  <?php if (!empty($profile->location)): ?>
                    <p>
                      <i class="glyphicon glyphicon-map-marker text-muted"></i> <?= Html::encode($profile->location) ?>
                    </p>
                  <?php endif; ?>
                  <?php if (!empty($profile->website)): ?>
                    <p>
                      <i class="glyphicon glyphicon-globe text-muted"></i> <?= Html::a(Html::encode($profile->website), Html::encode($profile->website)) ?>
                    </p>
                  <?php endif; ?>
                  <?php if (!empty($profile->public_email)): ?>
                    <p>
                      почта: <?= Html::a(Html::encode($profile->public_email), 'mailto:' . Html::encode($profile->public_email)) ?>
                    </p>
                  <?php endif; ?>
                  <?php if (!empty($profile->phone)): ?>
                    <p>
                      тел. <?= Html::encode($profile->phone) ?>
                    </p>
                  <?php endif; ?>
                  <?php if (!empty($profile->skype)): ?>
                    <p>
                      скайп: <?= Html::encode($profile->skype) ?>
                    </p>
                  <?php endif; ?>
                  <?php if (!empty($profile->icq)): ?>
                    <p>
                      icq: <?= Html::encode($profile->icq) ?>
                    </p>
                  <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="profile">
          <ul class="profile_nav clearfix">
            <li>
                <?= Html::a('Все друзья  <span>('.count($friends).')</span>', ['/friends', 'id' => $profile->user->id], ['class' => 'active']) ?>
            </li>
            <li>
                <?= Html::a('Лента <span>('.count($news).')</span>', ['/news', 'id' => $profile->user->id], ['class' => '']) ?>
            </li>
            <li>
                <?= Html::a('Трансляции <span>('.count($streams).')</span>', ['/stream', 'id' => $profile->user->id], ['class' => '']) ?>
            </li>
            <li>
                <?= Html::a('Товары <span>('.count($products).')</span>', ['/store', 'id' => $profile->user->id], ['class' => '']) ?>
            </li>
          </ul>

          <div class="friends">
            <ul class="friends_list clearfix">
                <?php

                foreach ($friends as $friend) {
                    echo '
                      <li class="friend_item clearfix">
                        <div class="friend_left">
                          <div class="friend_image">
                            ' . Html::img($friend->profile->getAvatarUrl(100), ['class' => '', 'alt' => $friend->username]) . '
                          </div>
                          <div class="friend_info">
                            ' . ($friend->getStatusOnline()?'<span class="online">Online</span>':'<span class="online">Offline</span>') . '
                            ' .  Html::a($friend->username, ['/user/profile/show', 'id' => $friend->id] , ['class' => 'name'])  . '
                            <div class="live" style="display: none;" >ИДЕТ ТРАНСЛЯЦИЯ</div>
                          </div>
                        </div>
                        <ul class="friend_right">
                          <li>
                            '. Html::a('Написать сообщение', ['/messages', 'id' => $friend->id] , ['class' => 'mess_btn']) .'
                          </li>
                          <li>
                           '. Html::a('Трансляции', ['/stream', 'id' => $friend->id] , ['class' => 'broadcasts_btn']) .'
                          </li>
                          <li>
                             '. Html::a('Убрать из друзей', ['friends/delete', 'id' => $friend->id] , ['class' => 'remove_btn']) .'
                          </li>
                        </ul>
                      </li>
                ';
                }

                ?>

            </ul>
          </div>


        </div>
      </div>
      <div class="section_right">
          <?= \common\widgets\Ads::widget() ?>
      </div>
    </div>
  </div>
</div>
