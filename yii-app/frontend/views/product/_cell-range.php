<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */
?>

      <?php foreach ($model->productRanges as $v): ?>
      <div>
        <?= $v->from ?> - <?= $v->to ?> <?= $v->unit ?>
      </div>
      <?php endforeach; ?>
