<?php
use common\models\Order;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
?>

<?= $model->statusName ?>
<br />
<?php if ($model->status == Order::STATUS_NEW): ?>

<?= Html::a('Взят в работу', ['set-status', 'id' => $model->id, 'status' => Order::STATUS_INPROGRESS],
    ['class' => 'btn btn-warning btn-sm']) ?>

<?php elseif ($model->status == Order::STATUS_INPROGRESS): ?>

<?= Html::a('Выполнен', ['set-status', 'id' => $model->id, 'status' => Order::STATUS_COMPLETE],
    ['class' => 'btn btn-success btn-sm']) ?>


<?php endif; ?>
