<?php
/* @var $this yii\web\View */

use common\models\Page;
use common\models\Seo;
use frontend\widgets\gazConverter\GazConverterWidget;


$seo = Seo::findOne(['type' => Seo::TYPE_PAGE_CONVERTER])->registerMetaTags($this);

$this->params['breadcrumbs'][] = $this->title;

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
     <h1><?= $seo->h1 ?></h1>

  <?= Page::findOne(['type' => Page::TYPE_CONVERTER])->content ?>

    <div class="row">
        <div class="col-sm-9 col-md-6 col-lg-4">
          <?= GazConverterWidget::widget(['title' => false]) ?>
        </div>
    </div>

</div>


