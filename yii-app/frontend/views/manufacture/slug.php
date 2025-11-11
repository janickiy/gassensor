<?php

/* @var $this yii\web\View */
/* @var $model common\models\Manufacture */

use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Производители', 'url' => '/' . $this->context->id];
$this->params['breadcrumbs'][] = $this->title;

if ($seo = $model->seo) {
    $seo->registerMetaTags($this);
    $this->title = $seo->title;
}

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
    <h1><?= $seo->h1 ?? $this->title ?></h1>

    <div id="post" class="single-post show">
        <div class="entry-summary seperate-border">
            <div class="manufacture-header">
                <div class="single-img">
                    <div class="img-main">
                        <?= Html::img($model->logoUrl, ['style' => "max-height: 100px;", 'loading' => "lazy", 'alt' => $model->title]) ?>
                    </div>
                </div>
                <div class="col">
                    <h3 id="manufacture-title"><?= $model->title ?></h3>
                    <?php if ($model->country): ?>
                        <div id="manufacture-country">
                            <i class="icon ion-md-map"></i>
                            <?= $model->country ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <i class="icon ion-md-map"></i> <a href="<?= $model->url ?>"><?= $model->url ?></a>
                    </div>
                    <div>
                        <i class="icon ion-md-map"></i> <a href="/catalog/manufacture/<?= $model->slug ?>">Перейти в товары
                            бренда <?= $model->title ?></a>
                    </div>
                </div>
            </div>
            <div class="delitimer"></div>
            <p id="manufacture-description">
                <?= $model->description ?>
            </p>
        </div>
    </div>

</div>


