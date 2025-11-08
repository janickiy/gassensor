<?php

/* @var $this yii\web\View */
/* @var $sensorsList common\models\SensorsList */
/* @var $dataProviderCatalog yii\data\ActiveDataProvider */

use common\models\News;
use common\models\Seo;
use common\models\Setting;
use frontend\widgets\GazLinks;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$dataProvider = new ActiveDataProvider([
    'query' => News::find()->orderBy('date DESC'),
    'pagination' => [
        'pageSize' => 8,
        'pageSizeParam' => false
    ],
]);

$seo = Seo::findOne(['type' => Seo::TYPE_PAGE_HOME])->registerMetaTags($this);

?>
<div class="site-index">

    <h1 class="text-center"><?= $seo->h1 ?></h1>

    <div class="row">
        <div class="col-xxl-2 col-md-3">
            <div class="sensors-count card p-2 bg-light">
                <div class="flex-grow-1 d-flex flex-column justify-content-center align-items-center">
                    <h3 class="text-center">Наличие<br>сенсоров на складе</h3>
                    <img src="./i/logo-excel.svg" alt="Логотип Excel" class="d-block text-center">
                </div>

                <a href="./upload/<?= Setting::getSensorsList() ?>" download class="btn btn-primary mt-4">
                    Скачать файл
                </a>
            </div>
        </div>
        <div class="col-xxl-8 col-md-6 order-first order-md-0">

            <?= $this->render('_grid', [
                'dataProvider' => $dataProviderCatalog,
                //'searchModel' => $searchModel,
            ]) ?>

            <p>Перейти в полный <a class="share" href="<?= Url::to(['/catalog']) ?>">каталог продукции Газсенсор &rarr;</a></p>

            <h2 class="text-center">Новости</h2>

            <div id="contentSection">
                <?php foreach ($dataProvider->getModels() as $model): ?>
                    <?= $this->render('_news-item', ['model' => $model]) ?>
                <?php endforeach; ?>
            </div>

            <p>Читать <a class="share" href="<?= Url::to(['/news']) ?>">все новости &rarr;</a></p>

        </div>
        <div class="col-md-2">

            <?= GazLinks::widget() ?>

        </div>
    </div>

</div>