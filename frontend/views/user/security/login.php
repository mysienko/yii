<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div id="sign_popup" class="white-popup-block">
  <h2>Вход на сайт</h2>
    <?php $form = ActiveForm::begin(
        [
            'id' => 'login-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
        ]
    ) ?>
    <?= $form->field(
        $model,
        'login',
        [
            'inputOptions' => [
                'placeholder' => 'Логин',
                'autofocus' => 'autofocus',
                'class' => 'form-control',
                'tabindex' => '1',
            ],
        ]
    )->label(false);
    ?>
    <?= $form->field(
        $model,
        'password',
        ['inputOptions' => ['placeholder' => 'Пароль', 'tabindex' => '2']]
    )
        ->passwordInput()
        ->label(false); ?>

  <div class="form_bottom">
      <?= Html::submitButton(
          Yii::t('user', 'Войти'),
          ['tabindex' => '4']
      ) ?>

    <a href="/user/recovery/request" class="forget_pass_btn">Забыли пароль?</a>
  </div>
    <?php ActiveForm::end(); ?>
  <div class="social">
    <div class="with_social">
        <?= Connect::widget(
            [
                'baseAuthUrl' => ['/user/security/auth'],
            ]
        ) ?>
      <div class="clearfix" style="display: none;">
        <a href="#" class="fb_btn">
          <span>Войти через Facebook</span>
        </a>

        <a href="#" class="vk_btn">
          <span>Войти через Vkontakte</span>
        </a>
      </div>
    </div>
  </div>
</div>
