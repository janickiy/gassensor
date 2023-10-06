<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */
?>
<div class="container">
    <div class="row">
        <div class="col-sm">

            <?php foreach ($model->ProductRangesByPos(0) as $v): ?>

                <div>
                    <?= $v->from ?> - <?= $v->to ?> <?= $v->unit ?>
                </div>

            <?php endforeach; ?>

        </div>
        <div class="col-sm">
            <?php foreach ($model->ProductRangesByPos(1) as $v): ?>

                <div>
                    <?= $v->from ?> - <?= $v->to ?> <?= $v->unit ?>
                </div>

            <?php endforeach; ?>
        </div>
        <div class="col-sm">
            <?php foreach ($model->ProductRangesByPos(2) as $v): ?>

                <div>
                    <?= $v->from ?> - <?= $v->to ?> <?= $v->unit ?>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>