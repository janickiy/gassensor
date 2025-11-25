<?php

/* @var $this yii\web\View */
/* @var $model common\models\News */

use common\helpers\Tools;
use common\helpers\StringHelpers;

?>
<header class="entry-header">
    <div class="entry-meta">
        <header class="entry-header">
            <div class="entry-meta">
                    <span class="posted-on">
                    <span class="entry-date published">
                    <?php
                    $time = strtotime($model->date);
                    ?>
                    <span class="date text-right">
                    <?= date('d', $time) ?>
                    <?= Tools::$months[date('n', $time) - 1] ?>
                    <?= date('Y', $time) ?>
                    </span>
                    </span>
            </div>
        </header>
    </div>
</header>

<p>
    <a href="/news/<?= $model->slug ?>"><?= StringHelpers::shortText($model->seo->h1 ?? $this->title, 100) ?></a>
</p>