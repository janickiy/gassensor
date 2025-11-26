<?php

/* @var $this yii\web\View */
/* @var $model common\models\News */

use common\helpers\StringHelpers;

$time = strtotime($model->date);

?>
<p>
    <span class="new-block"><?= date('d.m.Y', $time) ?> - </span>
    <a href="/news/<?= $model->slug ?>"><?= StringHelpers::shortText($model->seo->h1 ?? $this->title, 73) ?></a>
</p>