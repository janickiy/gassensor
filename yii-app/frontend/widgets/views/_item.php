<?php
/* @var $this yii\web\View */
/* @var  $model common\models\Gaz */
use yii\helpers\Html;

?>

<div class="col-12 g-0">
  <?= Html::a($model->title, "/catalog/{$model->slug}", ['class' => 'mb-1 gaz d-inline-block']) ?>
</div>
