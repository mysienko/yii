<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
$user = Yii::$app->user->identity;
?>

<header class="<?= Yii::$app->user->isGuest?'enter':'' ?>">
  <div class="head clearfix">
    <a href="/" class="logo">
      <img src="/images/logo.png" alt=""
    </a>
    <div class="head_center clearfix">
      <div class="head_broadcasting">
        <a href="#" class="broadcasting_btn">Трансляции</a>
        <div class="broadcasting_more">
          <ul class="broadcasting_more_list">
            <li>
              <a href="#">Авто</a>
              <div class="broadcasting_full clearfix">
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Начальная школа</h6>
                    <ul>
                      <li>
                        <a href="#">Математика</a>
                      </li>
                      <li>
                        <a href="#">Литература</a>
                      </li>
                      <li>
                        <a href="#">Русский язык</a>
                      </li>
                      <li>
                        <a href="#">Астрономия</a>
                      </li>
                      <li>
                        <a href="#">Физика</a>
                      </li>
                      <li>
                        <a href="#">Химия</a>
                      </li>
                      <li>
                        <a href="#">Медицина</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>МГУ им. Баумана</h6>
                    <ul>
                      <li>
                        <a href="#">Профессор химии</a>
                      </li>
                      <li>
                        <a href="#">Доцент ВуЗа</a>
                      </li>
                      <li>
                        <a href="#">Продленка</a>
                      </li>
                      <li>
                        <a href="#">Дополнительные занятия</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Техникум</h6>
                    <ul>
                      <li>
                        <a href="#">Для поступления</a>
                      </li>
                      <li>
                        <a href="#">Курсы подготовки</a>
                      </li>
                      <li>
                        <a href="#">Программирование</a>
                      </li>
                      <li>
                        <a href="#">ЛВС и сети</a>
                      </li>
                      <li>
                        <a href="#">Базы данных</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>Прочее</h6>
                    <ul>
                      <li>
                        <a href="#">Как начать учится</a>
                      </li>
                      <li>
                        <a href="#">Курсы ПЕД</a>
                      </li>
                      <li>
                        <a href="#">Начинающее</a>
                      </li>
                      <li>
                        <a href="#">ЭВМ</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">Производство</a>
            </li>
            <li>
              <a href="#">Бизнес</a>
              <div class="broadcasting_full clearfix">
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Начальная школа</h6>
                    <ul>
                      <li>
                        <a href="#">Математика</a>
                      </li>
                      <li>
                        <a href="#">Литература</a>
                      </li>
                      <li>
                        <a href="#">Русский язык</a>
                      </li>
                      <li>
                        <a href="#">Астрономия</a>
                      </li>
                      <li>
                        <a href="#">Физика</a>
                      </li>
                      <li>
                        <a href="#">Химия</a>
                      </li>
                      <li>
                        <a href="#">Медицина</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Техникум</h6>
                    <ul>
                      <li>
                        <a href="#">Для поступления</a>
                      </li>
                      <li>
                        <a href="#">Курсы подготовки</a>
                      </li>
                      <li>
                        <a href="#">Программирование</a>
                      </li>
                      <li>
                        <a href="#">ЛВС и сети</a>
                      </li>
                      <li>
                        <a href="#">Базы данных</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">Культура</a>
              <div class="broadcasting_full clearfix">
                <div class="broadcasting_full_block">
                  <div>
                    <h6>МГУ им. Баумана</h6>
                    <ul>
                      <li>
                        <a href="#">Профессор химии</a>
                      </li>
                      <li>
                        <a href="#">Доцент ВуЗа</a>
                      </li>
                      <li>
                        <a href="#">Продленка</a>
                      </li>
                      <li>
                        <a href="#">Дополнительные занятия</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>Начальная школа</h6>
                    <ul>
                      <li>
                        <a href="#">Математика</a>
                      </li>
                      <li>
                        <a href="#">Литература</a>
                      </li>
                      <li>
                        <a href="#">Русский язык</a>
                      </li>
                      <li>
                        <a href="#">Астрономия</a>
                      </li>
                      <li>
                        <a href="#">Физика</a>
                      </li>
                      <li>
                        <a href="#">Химия</a>
                      </li>
                      <li>
                        <a href="#">Медицина</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Прочее</h6>
                    <ul>
                      <li>
                        <a href="#">Как начать учится</a>
                      </li>
                      <li>
                        <a href="#">Курсы ПЕД</a>
                      </li>
                      <li>
                        <a href="#">Начинающее</a>
                      </li>
                      <li>
                        <a href="#">ЭВМ</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>Техникум</h6>
                    <ul>
                      <li>
                        <a href="#">Для поступления</a>
                      </li>
                      <li>
                        <a href="#">Курсы подготовки</a>
                      </li>
                      <li>
                        <a href="#">Программирование</a>
                      </li>
                      <li>
                        <a href="#">ЛВС и сети</a>
                      </li>
                      <li>
                        <a href="#">Базы данных</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">Консультации</a>
              <div class="broadcasting_full clearfix">
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Начальная школа</h6>
                    <ul>
                      <li>
                        <a href="#">Русский язык</a>
                      </li>
                      <li>
                        <a href="#">Астрономия</a>
                      </li>
                      <li>
                        <a href="#">Физика</a>
                      </li>
                      <li>
                        <a href="#">Химия</a>
                      </li>
                      <li>
                        <a href="#">Медицина</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>МГУ им. Баумана</h6>
                    <ul>
                      <li>
                        <a href="#">Профессор химии</a>
                      </li>
                      <li>
                        <a href="#">Доцент ВуЗа</a>
                      </li>
                      <li>
                        <a href="#">Продленка</a>
                      </li>
                      <li>
                        <a href="#">Дополнительные занятия</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Прочее</h6>
                    <ul>
                      <li>
                        <a href="#">Как начать учится</a>
                      </li>
                      <li>
                        <a href="#">Курсы ПЕД</a>
                      </li>
                      <li>
                        <a href="#">Начинающее</a>
                      </li>
                      <li>
                        <a href="#">ЭВМ</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>Техникум</h6>
                    <ul>
                      <li>
                        <a href="#">Для поступления</a>
                      </li>
                      <li>
                        <a href="#">Курсы подготовки</a>
                      </li>
                      <li>
                        <a href="#">Программирование</a>
                      </li>
                      <li>
                        <a href="#">ЛВС и сети</a>
                      </li>
                      <li>
                        <a href="#">Базы данных</a>
                      </li>
                      <li>
                        <a href="#">Математика</a>
                      </li>
                      <li>
                        <a href="#">Литература</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">Hi-Tech</a>
              <div class="broadcasting_full clearfix">
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Начальная школа</h6>
                    <ul>
                      <li>
                        <a href="#">Математика</a>
                      </li>
                      <li>
                        <a href="#">Литература</a>
                      </li>
                      <li>
                        <a href="#">Русский язык</a>
                      </li>
                      <li>
                        <a href="#">Астрономия</a>
                      </li>
                      <li>
                        <a href="#">Физика</a>
                      </li>
                      <li>
                        <a href="#">Химия</a>
                      </li>
                      <li>
                        <a href="#">Медицина</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>МГУ им. Баумана</h6>
                    <ul>
                      <li>
                        <a href="#">Профессор химии</a>
                      </li>
                      <li>
                        <a href="#">Доцент ВуЗа</a>
                      </li>
                      <li>
                        <a href="#">Продленка</a>
                      </li>
                      <li>
                        <a href="#">Дополнительные занятия</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Техникум</h6>
                    <ul>
                      <li>
                        <a href="#">Для поступления</a>
                      </li>
                      <li>
                        <a href="#">Курсы подготовки</a>
                      </li>
                      <li>
                        <a href="#">Программирование</a>
                      </li>
                      <li>
                        <a href="#">ЛВС и сети</a>
                      </li>
                      <li>
                        <a href="#">Базы данных</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>Прочее</h6>
                    <ul>
                      <li>
                        <a href="#">Как начать учится</a>
                      </li>
                      <li>
                        <a href="#">Курсы ПЕД</a>
                      </li>
                      <li>
                        <a href="#">Начинающее</a>
                      </li>
                      <li>
                        <a href="#">ЭВМ</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">Дом</a>
              <div class="broadcasting_full clearfix">
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Начальная школа</h6>
                    <ul>
                      <li>
                        <a href="#">Математика</a>
                      </li>
                      <li>
                        <a href="#">Литература</a>
                      </li>
                      <li>
                        <a href="#">Русский язык</a>
                      </li>
                      <li>
                        <a href="#">Астрономия</a>
                      </li>
                      <li>
                        <a href="#">Физика</a>
                      </li>
                      <li>
                        <a href="#">Химия</a>
                      </li>
                      <li>
                        <a href="#">Медицина</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>МГУ им. Баумана</h6>
                    <ul>
                      <li>
                        <a href="#">Профессор химии</a>
                      </li>
                      <li>
                        <a href="#">Доцент ВуЗа</a>
                      </li>
                      <li>
                        <a href="#">Продленка</a>
                      </li>
                      <li>
                        <a href="#">Дополнительные занятия</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Техникум</h6>
                    <ul>
                      <li>
                        <a href="#">Для поступления</a>
                      </li>
                      <li>
                        <a href="#">Курсы подготовки</a>
                      </li>
                      <li>
                        <a href="#">Программирование</a>
                      </li>
                      <li>
                        <a href="#">ЛВС и сети</a>
                      </li>
                      <li>
                        <a href="#">Базы данных</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>Прочее</h6>
                    <ul>
                      <li>
                        <a href="#">Как начать учится</a>
                      </li>
                      <li>
                        <a href="#">Курсы ПЕД</a>
                      </li>
                      <li>
                        <a href="#">Начинающее</a>
                      </li>
                      <li>
                        <a href="#">ЭВМ</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">Общество</a>
              <div class="broadcasting_full clearfix">
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Начальная школа</h6>
                    <ul>
                      <li>
                        <a href="#">Математика</a>
                      </li>
                      <li>
                        <a href="#">Литература</a>
                      </li>
                      <li>
                        <a href="#">Русский язык</a>
                      </li>
                      <li>
                        <a href="#">Астрономия</a>
                      </li>
                      <li>
                        <a href="#">Физика</a>
                      </li>
                      <li>
                        <a href="#">Химия</a>
                      </li>
                      <li>
                        <a href="#">Медицина</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>МГУ им. Баумана</h6>
                    <ul>
                      <li>
                        <a href="#">Профессор химии</a>
                      </li>
                      <li>
                        <a href="#">Доцент ВуЗа</a>
                      </li>
                      <li>
                        <a href="#">Продленка</a>
                      </li>
                      <li>
                        <a href="#">Дополнительные занятия</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Техникум</h6>
                    <ul>
                      <li>
                        <a href="#">Для поступления</a>
                      </li>
                      <li>
                        <a href="#">Курсы подготовки</a>
                      </li>
                      <li>
                        <a href="#">Программирование</a>
                      </li>
                      <li>
                        <a href="#">ЛВС и сети</a>
                      </li>
                      <li>
                        <a href="#">Базы данных</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>Прочее</h6>
                    <ul>
                      <li>
                        <a href="#">Как начать учится</a>
                      </li>
                      <li>
                        <a href="#">Курсы ПЕД</a>
                      </li>
                      <li>
                        <a href="#">Начинающее</a>
                      </li>
                      <li>
                        <a href="#">ЭВМ</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">Медицина</a>
              <div class="broadcasting_full clearfix">
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Начальная школа</h6>
                    <ul>
                      <li>
                        <a href="#">Математика</a>
                      </li>
                      <li>
                        <a href="#">Литература</a>
                      </li>
                      <li>
                        <a href="#">Русский язык</a>
                      </li>
                      <li>
                        <a href="#">Астрономия</a>
                      </li>
                      <li>
                        <a href="#">Физика</a>
                      </li>
                      <li>
                        <a href="#">Химия</a>
                      </li>
                      <li>
                        <a href="#">Медицина</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>МГУ им. Баумана</h6>
                    <ul>
                      <li>
                        <a href="#">Профессор химии</a>
                      </li>
                      <li>
                        <a href="#">Доцент ВуЗа</a>
                      </li>
                      <li>
                        <a href="#">Продленка</a>
                      </li>
                      <li>
                        <a href="#">Дополнительные занятия</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Техникум</h6>
                    <ul>
                      <li>
                        <a href="#">Для поступления</a>
                      </li>
                      <li>
                        <a href="#">Курсы подготовки</a>
                      </li>
                      <li>
                        <a href="#">Программирование</a>
                      </li>
                      <li>
                        <a href="#">ЛВС и сети</a>
                      </li>
                      <li>
                        <a href="#">Базы данных</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>Прочее</h6>
                    <ul>
                      <li>
                        <a href="#">Как начать учится</a>
                      </li>
                      <li>
                        <a href="#">Курсы ПЕД</a>
                      </li>
                      <li>
                        <a href="#">Начинающее</a>
                      </li>
                      <li>
                        <a href="#">ЭВМ</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">Искусство</a>
            </li>
            <li>
              <a href="#">Кулинария</a>
              <div class="broadcasting_full clearfix">
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Начальная школа</h6>
                    <ul>
                      <li>
                        <a href="#">Математика</a>
                      </li>
                      <li>
                        <a href="#">Литература</a>
                      </li>
                      <li>
                        <a href="#">Русский язык</a>
                      </li>
                      <li>
                        <a href="#">Астрономия</a>
                      </li>
                      <li>
                        <a href="#">Физика</a>
                      </li>
                      <li>
                        <a href="#">Химия</a>
                      </li>
                      <li>
                        <a href="#">Медицина</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>МГУ им. Баумана</h6>
                    <ul>
                      <li>
                        <a href="#">Профессор химии</a>
                      </li>
                      <li>
                        <a href="#">Доцент ВуЗа</a>
                      </li>
                      <li>
                        <a href="#">Продленка</a>
                      </li>
                      <li>
                        <a href="#">Дополнительные занятия</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="broadcasting_full_block">
                  <div>
                    <h6>Техникум</h6>
                    <ul>
                      <li>
                        <a href="#">Для поступления</a>
                      </li>
                      <li>
                        <a href="#">Курсы подготовки</a>
                      </li>
                      <li>
                        <a href="#">Программирование</a>
                      </li>
                      <li>
                        <a href="#">ЛВС и сети</a>
                      </li>
                      <li>
                        <a href="#">Базы данных</a>
                      </li>
                    </ul>
                  </div>
                  <div>
                    <h6>Прочее</h6>
                    <ul>
                      <li>
                        <a href="#">Как начать учится</a>
                      </li>
                      <li>
                        <a href="#">Курсы ПЕД</a>
                      </li>
                      <li>
                        <a href="#">Начинающее</a>
                      </li>
                      <li>
                        <a href="#">ЭВМ</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <a href="#">Юриспруденция</a>
            </li>
          </ul>
        </div>
      </div>
      <ul class="head_links clearfix">
        <li>
          <a href="/search">
            <img src="/images/search_icon.png" alt="">
          </a>
        </li>
        <li>
          <a href="/">
            <img src="/images/home_icon.png" alt="">
          </a>
        </li>
        <li>
            <?php
            // $itemsCount = \Yii::$app->cart->getCount();
            echo Html::a('<img src="/images/basket_icon.png" alt="">', ['/cart'], ['class' => 'in']);
            ?>
        </li>
        <li>
            <?= Html::a('<img src="/images/mess_icon.png" alt="">', ['/messages'], ['class' => 'in']) ?>
        </li>
        <li>
          <a href="/user/purse">
            <img src="/images/user_icon.png" alt="">
          </a>
        </li>
        <li>
          <a href="/stream">
            <img src="/images/cam_icon.png" alt="">
          </a>
        </li>
        <li>
          <a href="#">
            <img src="/images/seeing_icon.png" alt="">
          </a>
        </li>
      </ul>
      <div class="head_purse">
        <span class="new">0</span>
        <div class="money">0 р.</div>
      </div>
    </div>
    <div class="head_right">
        <?php if (Yii::$app->user->isGuest) : ?>
          <div class="reg_sign clearfix">
            <a href="/user/login" class="sign_btn">Вход</a>
            <a href="/user/register" class="reg_btn">Регистрация</a>
          </div>
        <?php else : ?>
          <div class="head_account_block">
            <a href="#" class="head_account">
                    <span class="account_image">
                        <img src="/images/user_avatar.png" alt="">
                        <?php
                        //echo Html::img(Yii::$app->user->identity->thumb(100,100, true), ['class'=>'']);
                        ?>
                    </span>
              <span class="name"><?php echo Yii::$app->user->identity->username ?></span>
            </a>
            <div class="head_account_more">
              <ul>
                <li class="my_page_li">
                    <?= Html::a('Моя страница', ['/user/profile']) ?>
                </li>
                <li class="purchase_li">
                    <?= Html::a('Покупки', ['/products']) ?>
                </li>
                <li class="message_li">
                    <?= Html::a('Сообщения', ['/messages']) ?>
                </li>
                <li class="friends_li">
                    <?= Html::a('Друзья', ['/friends']) ?>
                </li>
                <li class="photo_li">
                    <?= Html::a('Фото', ['/photo']) ?>
                </li>
                <li class="exit_li">
                    <?php
                    echo Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Выход',
                            ['class' => 'logout']
                        )
                        . Html::endForm()
                    ?>
                </li>
              </ul>
            </div>

          </div>
        <?php endif; ?>
    </div>
    <a href="#" class="mob_open_btn">
      <span></span>
      <span></span>
      <span></span>
    </a>
  </div>

    <?php if (!Yii::$app->user->isGuest) : ?>
      <div class="mobile_head">
        <div class="mob_head_top">
          <a href="#" class="mob_head_account">
                    <span class="account_image">
                        <img src="images/user_avatar.png" alt="">
                    </span>
            <span class="name"><?//= Yii::$app->user->identity->name ?></span>
          </a>
          <a href="#" class="menu_close_btn">
            <img src="images/menu_close.png" alt="">
          </a>
        </div>
        <div class="mob_head_body">
          <ul class="mob_head_info">
            <li class="my_page_li">
              <a href="#">Моя страница</a>
            </li>
            <li class="broadcasting_li">
              <a href="#">Трансляции</a>
            </li>
            <li class="news_li">
              <a href="#">Новости</a>
            </li>
            <li class="purchase_li">
              <a href="#">Покупки</a>
            </li>
            <li class="message_li">
              <a href="#">
                Сообщения
                <span class="new">3</span>
              </a>
            </li>
            <li class="friends_li">
              <a href="#">Друзья</a>
            </li>
            <li class="photo_li">
              <a href="#">Фото</a>
            </li>
            <li class="balance_li">
              <div class="mob_balance">
                <p>Баланс кошелька: 5 900 р.</p>
                <span class="new">3</span>
              </div>
            </li>
            <li class="exit_li">
              <a href="#">Выход</a>
              <?php
              echo Html::beginForm(['/site/logout'], 'post')
              . Html::submitButton(
              'Logout (' . Yii::$app->user->identity->username . ')',
              ['class' => 'btn btn-link logout']
              )
              . Html::endForm()
              ?>
            </li>
          </ul>
        </div>
      </div>
    <?php endif; ?>
</header>

<div class="wrap">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<footer>
  <nav>
    <ul class="foo_nav">
      <li>
        <a href="#">Ответы на вопросы</a>
      </li>
      <li>
        <a href="#">Соглашение</a>
      </li>
      <li>
        <a href="#">О нас</a>
      </li>
      <li>
        <a href="#">Реклама</a>
      </li>
    </ul>
  </nav>
  <div class="copypast">
    <p>© 2006-<?php echo date('Y');?> — живые трансляции unesis.net</p>
  </div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
