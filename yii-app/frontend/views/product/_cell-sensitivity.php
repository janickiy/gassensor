<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */

?>

<div class="container">
    <div class="row">

        <?php if ($model->first === 1): ?>

            <div class="col-sm">

                <?php /* Yii::t('app', 'First') */?>

                <?= $model->sensitivity_first ?>

            </div>

        <?php endif; ?>

        <?php if ($model->analog === 1): ?>

            <div class="col-sm">

                <?php /* Yii::t('app', 'Analog') */?>

                <?= $model->sensitivity_analog ?>

            </div>

        <?php endif; ?>

        <?php if ($model->digital === 1): ?>

            <div class="col-sm">

                <?php /* Yii::t('app', 'Digital') */?>

                <?= $model->sensitivity_digital ?>

            </div>

        <?php endif; ?>

    </div>
</div>
