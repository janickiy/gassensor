<?php

/* @var $this yii\web\View */
/* @var $sensorsList common\models\SensorsList */

/* @var $dataProviderCatalog yii\data\ActiveDataProvider */

use common\models\News;
use common\models\Seo;
use common\models\Page;
use frontend\widgets\GazLinks;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$dataProvider = new ActiveDataProvider([
    'query' => News::find()->orderBy('date DESC'),
    'pagination' => [
        'pageSize' => 20,
        'pageSizeParam' => false
    ],
]);

$dataProviderNews = new ActiveDataProvider([
    'query' => News::find()->orderBy('date DESC'),
    'pagination' => [
        'pageSize' => 4,
        'pageSizeParam' => false
    ],
]);

$seo = Seo::findOne(['type' => Seo::TYPE_PAGE_HOME])->registerMetaTags($this);
$seoHome = Seo::findOne(['type' => Seo::TYPE_PAGE_ABOUT])->registerMetaTags($this);

?>
<style>

.post-box {
    margin-bottom: 12px;
}

</style>
<div class="site-index">

    <h1 class="text-center"><?= $seo->h1 ?></h1>

    <div class="row">
        <div class="col-xxl-2 col-md-3">

            <p style="font-size: 16px; font-weight: bold">Новости</p>

            <?php foreach ($dataProvider->getModels() ?? [] as $model): ?>
                <?= $this->render('_news-list', ['model' => $model]) ?>
            <?php endforeach; ?>

            <p><a class="share" href="<?= Url::to(['/news']) ?>">Читать все новости...</a></p>

        </div>

        <div class="col-xxl-8 col-md-6 order-first order-md-0">

            <?= $this->render('_grid', [
                'dataProvider' => $dataProviderCatalog,
                //'searchModel' => $searchModel,
            ]) ?>

            <p><a class="share" href="<?= Url::to(['/catalog']) ?>">Перейти в каталог продукции Газсенсор &rarr;</a></p>

            <h2>Новости</h2>

            <div id="contentSection">
                <?php foreach ($dataProviderNews->getModels() ?? [] as $model): ?>
                    <?= $this->render('_news-item', ['model' => $model]) ?>
                <?php endforeach; ?>
            </div>

            <p><a class="share" href="<?= Url::to(['/news']) ?>">Читать все новости &rarr;</a></p>

            <h2><?= $seoHome->h1 ?></h2>

            <?= Page::findOne(['type' => Page::TYPE_ABOUT])->content ?>


        </div>
        <div class="col-md-2">

            <?= GazLinks::widget() ?>

        </div>
    </div>

</div>