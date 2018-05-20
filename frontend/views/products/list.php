<?php

use yii\helpers\Html;

?>

<div class="image">
    <?= Html::a(Html::img($model->thumb(150, 150)), ['products/view', 'id' => $model->id], ['class' => '']) ?>
</div>
<div class="goods_name"><?= Html::a($model->title, ['products/view', 'id' => $model->id], ['class' => '']) ?></div>
<div class="goods_price"><?= $model->price ?> <?= $model->currency ?></div>
<a href="<?= Yii::$app->urlManager->createUrl(['products/buy', 'id' => $model->id,]) ?>"
   class="to_basket_btn"><?= Yii::t('app', 'В корзину') ?></a>
