<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Друзья';
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="friends" class="section section_full">
  <div class="content">
    <div class="friends_top clearfix">
      <h2>Друзья</h2>
      <div class="friends_types">
        <a href="/friends" class="active all_friends">
          Все друзья
          <span><?= count($friends) ?></span>
        </a>
        <a href="/friends/online" class="friends_online">
          Друзья онлайн
          <span><?= count($online) ?></span>
        </a>
        <a href="/friends/request" class="add_on_requests">
          Запросы на добавления
          <span><?= count($requests) ?></span>
        </a>
      </div>
      <div class="search_friends">
        <input type="text" placeholder="Найти друзей">
      </div>
    </div>
    <div class="clearfix">
      <div class="section_left">
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
  </div>
</div>

