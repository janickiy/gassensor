<?php
/* @var $this yii\web\View */

use common\models\News;
use common\models\Seo;
use frontend\widgets\GazLinks;
use frontend\widgets\gazConverter\GazConverterWidget;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

$dataProvider = new ActiveDataProvider(['query' => News::find()->orderBy('date DESC')]);
$listView = new ListView(['dataProvider' => $dataProvider]);

$seo = Seo::findOne(['type' => Seo::TYPE_PAGE_HOME])->registerMetaTags($this);

?>
<div class="site-index">

  <h1 class="text-center"><?= $seo->h1 ?></h1>

<div class="row">
    <div class="col-md-9">

        <div id="contentSection">
          <?php foreach ($dataProvider->getModels() as $model): ?>
            <?= $this->render('_news-item', ['model' => $model]) ?>
          <?php endforeach; ?>
        </div>

        <?= $listView->renderPager() ?>

    </div>
    <div class="col-md-3">

      <?= GazConverterWidget::widget() ?>

      <?= GazLinks::widget() ?>
    </div>
</div>




</div>


