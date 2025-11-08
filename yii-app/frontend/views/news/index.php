<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use common\models\Seo;

$seo = Seo::findOne(['type' => Seo::TYPE_PAGE_NEWS])->registerMetaTags($this);

$this->params['breadcrumbs'][] = $this->title;

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
    <h1><?= $seo->h1 ?></h1>

    <div id="contentSection">
        <?php foreach ($dataProvider->getModels() as $model): ?>
            <?= $this->render('_news-item', ['model' => $model]) ?>
        <?php endforeach; ?>

        <?= $listView->renderPager() ?>

    </div>

</div>


