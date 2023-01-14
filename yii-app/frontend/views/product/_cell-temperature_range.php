<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */
?>

<?= $model->temperature_range_from ?>C°..
<?= $model->temperature_range_to > 0 ? '+' : '' ?>
<?= $model->temperature_range_to ?>C°
