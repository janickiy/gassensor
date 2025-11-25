<?php

/* @var $this yii\web\View */
/* @var $model common\models\News */

use common\helpers\StringHelpers;

$time = strtotime($model->date);

?>
<p>
    <b><?= date('d.m.Y', $time) ?> - </b>
    <a href="/news/<?= $model->slug ?>"><?= StringHelpers::shortText($model->seo->h1 ?? $this->title, 100) ?></a>
</p>