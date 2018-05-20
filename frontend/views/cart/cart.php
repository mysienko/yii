<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Catalog;
use kartik\tree\TreeView;
use kartik\tree\Module;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>


<div id="basket" class="section section_full">
    <div class="content">
        <div class="clearfix">
            <div class="section_left">
                <div class="section_top basket_top clearfix">
                    <h2 class="basket_title">Корзина</h2>
                    <div class="basket_balance">
                        <span>Баланс: 0 р.</span>
                        <a href="#" class="add_balance_btn">
                            <b>Пополнить баланс</b>
                            <b class="add_balance_btn_mob">+</b>
                        </a>
                    </div>
                </div>
				
				<?php if ($total != 0) : ?>
					<?php $form = ActiveForm::begin();?>
				
					<div class="basket">
						<div class="basket_title">
							<ul>
								<li class="product_name_text">Название</li>
								<li class="product_count_text">Количество</li>
								<li class="product_price_text">Сумма</li>
								<li class="product_delete_text"></li>
							</ul>
						</div>
						<?php foreach ($positions as $position) { ?>
							<div class="basket_item clearfix">
								<div class="item_pic">
									<?= Html::a(Html::img($position->product->thumb(100, 100)), ['products/view','id' => $position->product->id], ['class' => '']) ?>
								</div>
								<div class="info">
									<span class="product_category"></span>
									<span class="product_name">
                                        <?= Html::a($position->product->title, ['products/view','id' => $position->product->id], ['class' => '']) ?>
                                    </span>
								</div>
								<div class="product_count">
									<a href="#" class="plus cart-quantity-plus">+</a>
									<input type="text" name="quantity[<?= (($position->type=='simple')?$position->type:'').$position->product->id ?>]" class="count_input" value="<?= $position->quantity ?>" maxlength="3" >
									<a href="#" class="minus cart-quantity-minus">–</a>
								</div>
								<div class="price"><?= ($position->quantity * $position->price).' ' ?></div>
								<a href="<?= Yii::$app->urlManager->createUrl(['cart/delete','id' => $position->id, 'type' => $position->type])?>" class="delete">
									<img src="images/delete_icon.png" alt="">
								</a>
							</div>	
						<?php } ?>

					</div>
					<div class="basket_bottom clearfix">
						<div class="coupon">
							<span>Есть купон?</span>
							<input type="text" placeholder="Номер купона">
						</div>
						<div class="pay_now">
							<div class="pay_now_block">
								<p>Итого: <span><?= $total ?> руб.</span></p>
                                <?= Html::submitButton(Yii::t('app', 'Обновить'), ['name' => 'update', 'class' => 'pay_btn']);?>
                                <?= Html::submitButton(Yii::t('app', 'Оплатить покупки'), ['name' => 'confirm', 'class' => 'pay_btn']);?>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="payment_icons">
							<img src="/images/payment_icons.png" alt="">
						</div>
					</div>
	 
	         <?php ActiveForm::end(); ?>
			 
			<?php else: ?>

				Корзина пуста
		
	         <?php endif; ?>
			 
			</div>
            <div class="section_right">
                <?= \common\widgets\Ads::widget() ?>
            </div>
        </div>
    </div>
</div>

<?php
        /*
        $form = ActiveForm::begin([
            'action' => Url::to(['/shop/checkout'])
        ]);
        echo $form->field($model, 'name');
        echo $form->field($model, 'address');
        echo $form->field($model, 'email');
        echo $form->field($model, 'phone');
        echo $form->field($model, 'comment')->textarea();
        echo Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary']);
        ActiveForm::end();
        
        */
?>