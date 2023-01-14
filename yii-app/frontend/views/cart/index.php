<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => '/catalog'];
$this->params['breadcrumbs'][] = $this->title;

/* @var \common\components\cart\Cart $cart */
$cart = Yii::$app->cart;

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
     <h1><?= $this->title ?></h1>

<table>

<tr>
	<th>Товар</th>
    <th>Кол-во, шт</th>
    <th></th>
</tr>

<?php foreach ($cart->getItems() as $id => $data): ?>
<tr>
    <td>
      <?= Html::a($data->product->name, "/product/{$data->product->slug}") ?>
    </td>
    <td>
    	<?= Html::input('number', 'count', $data->count, ['class' => 'cart-item-count', 'data-id' => $data->product->id,]) ?>
    </td>

    <td>
      <?= Html::a('<i class="ion-md-trash"></i> Удалить', ['del', 'id' => $id]) ?>
    </td>

</tr>
<?php endforeach; ?>

</table>

<?php if ($cart->isEmpty()): ?>
Корзина пуста. Перейти в <?= Html::a('Каталог товаров', '/catalog') ?>
<?php else: ?>

  <?= Html::a('<i class="ion-md-trash"></i> Очистить корзину', ['clear',], ['class' => 'btn']) ?>

  <?= Html::a('<i class="ion-md-done-all"></i> Оформить заказ', ['order/create',], ['class' => 'btn', 'onclick' => "ym(85084891,'reachGoal','CLICK_ON_COMLETE')"]) ?>

<?php endif; ?>

</div>


