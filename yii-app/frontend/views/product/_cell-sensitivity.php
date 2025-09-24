<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */

?>

<div class="container">
    <div class="row">

        <?php if ($model->first === 1): ?>

            <div class="col-sm">

                <?= Yii::t('app', 'First') ?><br>

                <?= $model->sensitivity_first ?>

            </div>

        <?php endif; ?>

        <?php if ($model->analog === 1): ?>

            <div class="col-sm">

                <?= Yii::t('app', 'Analog') ?><br>

                <?= $model->sensitivity_analog ?>

            </div>

        <?php endif; ?>

        <?php if ($model->digital === 1): ?>

            <div class="col-sm">

                <?= Yii::t('app', 'Digital') ?><br>

                <?= $model->sensitivity_digital ?>

            </div>

        <?php endif; ?>

    </div>
</div>
