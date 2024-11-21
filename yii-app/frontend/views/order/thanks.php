<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order|null */

$this->title = 'Создан заказ';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'sort' => '-id']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
     <h1><?= $this->title ?></h1>

<div class="row my-2">
	<div class="col">
        <p>
          Спасибо! С Вами свяжутся в ближайшее время.
        </p>
	</div>
	<div class="col">
		<?= Html::a('Продолжить поиск сенсора', '/catalog', ['class' => 'btn', 'onclick' => "ym(85084891,'reachGoal','CLICK_ON_SEARCH_SPONSOR')"]) ?>
	</div>
</div>


    <?php if ($model): ?>
    <div class="border">
        <h3>Данные заказа</h3>

        <div class="row">
            <div class="col-sm-6">
                <ul>
                	<li>Получатель: <b><?= $model['name'] ?></b> <?= $model['email'] ?> <?= $model['phone'] ?></li>
                    <li>Доставка: <?= $model['delivery_info'] ?></li>
                    <li>Комментарий: <?= $model['comment'] ?></li>
                </ul>
            </div>
            <div class="col-sm-6">
              <h4>Товары</h4>
              <ul>
              <?php foreach ($model['items'] ?? [] as $v): ?>
                <li><?= $v['name'] ?> (<?= $v['count'] ?> шт)</li>
              <?php endforeach; ?>
              </ul>

            </div>
        </div>
    </div>
    <?php endif; ?>


</div>


