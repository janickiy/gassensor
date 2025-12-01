<?php

/* @var $this yii\web\View */
/* @var $model common\models\News */

use yii\helpers\Html;

?>
<a class="col-md-4 col-sm-6 col-xs-12 news-box p-1" href="/catalog/manufacture/<?= $model->slug ?>">
    <div class="post-manufacture post type-post entry">
        <div class="entry-media">
            <?= Html::img($model->logoUrl, ['style' => "max-height: 100px;", 'loading' => "lazy", 'alt' => $model->title, 'title' => $model->title]) ?>
        </div>
    </div>
</a>