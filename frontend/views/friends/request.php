<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FriendsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки в друзья';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="friends_requests" class="section section_full">
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
      <h6>Запросы на добавление:</h6>
    </div>
    <div class="clearfix">
      <div class="section_left">
        <div class="friends_request">
          <ul class="friends_request_list clearfix">
            <?php

                foreach ($requests as $friend) {
                    echo '
                      <li class="friends_request_item clearfix">
                        <div class="friends_request_left">
                          <div class="friend_image">
                             '.Html::img(
                            $friend->profile->getAvatarUrl(100),
                            ['class' => '', 'alt' => $friend->username]
                        ).'
                          </div>
                          <div class="friend_info">
                             '.Html::a(
                            $friend->username,
                            ['/user/profile/show', 'id' => $friend->id],
                            ['class' => 'name']
                        ).'
                          </div>
                        </div>
                        <div class="friends_request_right">
                          '.Html::a(
                            'Добавить',
                            ['friends/approve', 'id' => $friend->id],
                            ['class' => 'add_friend']
                        ).'
                          '.Html::a(
                            'Отказать',
                            ['friends/delete', 'id' => $friend->id],
                            ['class' => 'refuse_friend']
                        ).'
                        </div>
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
