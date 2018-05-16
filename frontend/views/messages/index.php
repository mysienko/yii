<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="messages" class="section section_full">
  <div class="content">
    <div class="clearfix">
      <div class="section_left">
        <div class="section_top clearfix">
          <h2 class="messages_title">Сообщения</h2>
        </div>
        <div class="messages clearfix">
          <div class="messages_dialog">
            <div class="search_dialog">
              <input type="text" placeholder="Найти диалог">
            </div>
            <ul class="dialogs_list">
                <?php
                foreach ($recipients as $recipient) {

                 echo '
									<li class="dialog_item">
										<a href="'.Url::to(['/messages', 'id' => $recipient_id]).'">
											<div class="dialog_avatar">
												'.Html::img($recipient->thumb(90, 100, true), ['class' => '']).'
											</div>
											<div class="dialog_info">' .(($recipient->getStatusOnline())?'<div class="online_offline online">в сети</div>' : '<div class="online_offline offline">не в сети</div>' ).
                       '<div class="name">'.$recipient->name.'</div>
												<em class="part_of_mess">...</em>
											</div>
											<span class="time">'. date('H:i', $recipient->last_visit_at) .' </span>
										</a>
									</li>								
										';
                }
                ?>
            </ul>
          </div>
          <div class="messages_private">
            <div class="private_top">
              <?php if (isset($current_recipient)) : ?>
              <p><?= $current_recipient->name ?> <span>был в сети в <?= date('H:i', $current_recipient->last_visit_at) ?></span></p>
              <?php endif; ?>
              <a href="#" class="private_more_btn">
                <span></span>
                <span></span>
                <span></span>
              </a>
            </div>
            <div class="chat">

                <?php
                foreach ($messages as $message) {
                    $messageRecipient = $message['user'];
                    echo '
											<div class="chat_message">
												<div class="chat_image">
													'.Html::img($messageRecipient->thumb(100, 100, true), ['class' => '']).'
												</div>
												<div class="chat_name">'.@$messageRecipient->name.' <span class="mess_time"> '.date('H:i', $message['updated_at']).'</span></div>
												<em class="mess_text">'.$message['message'].'</em>
											</div>
										  ';
                }
                ?>
          </div>
            <div class="write_message">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'message')
                    ->textarea(['rows' => 6])
                    ->label(false) ?>
                <?= Html::submitButton('Отправить', ['class' => 'send_btn']) ?>
                <?= Html::hiddenInput('Messages[recipient]', $recipient_id); ?>
                <?= Html::hiddenInput(
                    'Messages[author]',
                    Yii::$app->user->id
                ); ?>
                <?php ActiveForm::end(); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="section_right">
        <div class="now_on_air">
          <h3>Сейчас в эфире</h3>
          <ul class="now_on_air_list clearfix">
            <li>
              <a href="#">
                <img src="images/img1.jpg" alt="">
              </a>
            </li>
            <li>
              <a href="#">
                <img src="images/img1.jpg" alt="">
              </a>
            </li>
            <li>
              <a href="#">
                <img src="images/img1.jpg" alt="">
              </a>
            </li>
            <li>
              <a href="#">
                <img src="images/img1.jpg" alt="">
              </a>
            </li>
            <li>
              <a href="#">
                <img src="images/img1.jpg" alt="">
              </a>
            </li>
            <li>
              <a href="#">
                <img src="images/img1.jpg" alt="">
              </a>
            </li>
          </ul>
          <a href="#" class="more_broadcast_btn">еще трансляции</a>
        </div>
      </div>
    </div>
  </div>
</div>