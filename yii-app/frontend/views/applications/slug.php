<?php
/* @var $this yii\web\View */
/* @var $model common\models\Applications */

use common\models\Seo;
use yii\helpers\Html;

$seo = Seo::findOne(['type' => Seo::TYPE_APPLICATIONS])->registerMetaTags($this);
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '/applications'];
$this->params['breadcrumbs'][] = $model->title;

if ($seo = $model->seo) {
    $seo->registerMetaTags($this);
}

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
    <h1><?= $model->seo->h1 ?? $this->title ?></h1>

    <div class="single-img w-100">
        <div class="" id="news-photo-block">
            <p id="news-content">
                <?= $model->content ?>
            </p>
        </div>

        <?php if (Yii::$app->user->isAdmin()): ?>
            <div class="mt-5">

                <?= Html::a('<i class="fa fa-edit m-1"></i>',
                    ['backend/applications/update',
                        'id' => $model->id,],
                    ['class' => "btn d-inline rounded-pill",
                        'target' => "_blank",
                        'style' => "font-size: 0.8rem; padding: 4px; background: red;"
                    ]) ?>
            </div>
        <?php endif; ?>

    </div>

</div>

