<?php
/* @var $this yii\web\View */

/* @var $model common\models\Product */

use \yii\helpers\ArrayHelper;

?>
<div class="container">
    <div class="row">
        <div class="col-sm">

            <?= ArrayHelper::getValue($model, 'mainGaz.title') ?>

            <?php

            $productRanges1 = $model->ProductRangesByPos(0);

            if ($productRanges1 && is_array($productRanges1)):

            ?>

                <?php foreach ($productRanges1 as $v): ?>

                <div>
                    <nobr><?= $v->from ?> - <?= $v->to ?> <?= $v->unit ?></nobr>
                </div>

            <?php endforeach; ?>

            <?php endif; ?>

        </div>

        <?= ArrayHelper::getValue($model, 'mainGaz2.title') ?>

        <?php

        $productRanges2 = $model->ProductRangesByPos(1);

        if ($productRanges2 && is_array($productRanges2)):

        ?>
            <div class="col-sm">
                <?php foreach ($productRanges2 as $v): ?>

                    <div>
                        <nobr><?= $v->from ?> - <?= $v->to ?> <?= $v->unit ?></nobr>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?= ArrayHelper::getValue($model, 'mainGaz3.title') ?>

        <?php

        $productRanges3 = $model->ProductRangesByPos(2);

        if ($productRanges3 && is_array($productRanges3)):

        ?>
            <div class="col-sm">
                <?php foreach ($productRanges3 as $v): ?>

                    <div>
                        <nobr><?= $v->from ?> - <?= $v->to ?> <?= $v->unit ?></nobr>
                    </div>

                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>