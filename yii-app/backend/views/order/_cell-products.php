<?php
use common\models\Order;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
?>


<ul>
    <?php foreach ($model->orderProducts as $v): ?>
      <li>
        <?= Html::a($v->product_info, ['product/view', 'id' => $v->product_id], ['target' => '_blank', 'data-pjax' => 0]) ?>
        (<?= $v->count ?> шт)
      </li>
    <?php endforeach; ?>
</ul>

