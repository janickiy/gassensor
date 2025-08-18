<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */

$sensitivity = [];

if ($model->first === 1) $sensitivity[] = Yii::t('app', 'Primary');
if ($model->analog === 1) $sensitivity[] = Yii::t('app', 'Analog');
if ($model->digital === 1) $sensitivity[] = Yii::t('app', 'Digital');

?>

<?= $model->sensitivity ?> <?= $model->sensitivity_unit ?> <?= implode(', ', $sensitivity) ?>