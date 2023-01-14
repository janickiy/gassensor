<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */
?>

<?php foreach ($model->productRanges as $v): ?>
    <div class="card my-1">
      <?= $v->from ?> - <?= $v->to ?> <?= $v->unit ?>
    </div>
<?php endforeach; ?>
