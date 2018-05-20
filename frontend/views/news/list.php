<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$user = Yii::$app->user->identity;
?>

<div class="news_item news_item_list">
	<div class="news_user">
		<div class="user_image">
			<?php echo Html::img($model->authorModel->thumb(100,100, true), ['class'=>'']);?>
		</div>
		<div>
			<a href="<?= Url::to(['/user/profile/show', 'id' => $model->author]) ?>" class="user_name">
                <?= $model->authorModel->name ?>
            </a>
			<span class="date"><?= date('d.m.Y H:i', $model->updated_at) ?></span>
		</div>
	</div>
	<h4>
        <a href="<?= Url::to(['/news/view', 'id' => $model->id]) ?>" class="">
            <?= $model->title ?>
        </a>
    </h4>
    <div class="post_content">
        <?= StringHelper::truncate($model->body, '500', '...', null, TRUE) ?>
    </div>
</div>








