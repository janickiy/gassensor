<?php
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $seo common\models\Seo|null */

use common\models\Seo;
use frontend\widgets\gazConverter\GazConverterWidget;
use yii\helpers\Html;

$this->title = 'Каталог';

$this->params['breadcrumbs'][] = $this->title;

if (!$seo) {
    $seo = Seo::findOne(['type' => Seo::TYPE_PAGE_CATALOG]);
    $this->title = $seo->title;
}
$seo->registerMetaTags($this);

/* @var $request \yii\web\Request */
$req = Yii::$app->request;

$js =
    <<<JS
$('#productsearch-manufacture_id').on('change', function () {
   let manufactureId =  this.value;
   
   $.ajax({
        type: 'GET',
        url: './catalog/gaz/' + manufactureId,
        success: function (data) {
            $('#productsearch-gaz_id').empty();
            $('#productsearch-gaz_id').append(data);
        }
    });

  console.log('Changed option value ' + this.value);
  console.log('Changed option text ' + $(this).find('option').filter(':selected').text());
});
JS;

$this->registerJs($js, $this::POS_READY);

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> px-2'>
    <h1><?= $seo->h1 ?? $this->title ?></h1>

    <?php if ($req->get('ProductSearch')): ?>
        <?= Html::a('Сброс фильтров', '/products', ['class' => 'btn mb-2']) ?>
    <?php endif; ?>

    <div class="row">
        <div class="filter-wrap col-lg-2 col-md-3 bg-light border py-1">

            <?= $this->render('_filter', [
                'model' => $searchModel,
            ]) ?>

        </div>
        <div class="col-md-7">

            <?= $this->render('_grid', [
                'dataProvider' => $dataProvider,
                //'searchModel' => $searchModel,
            ]) ?>

        </div>
        <div class="col-md-3">
            <?= GazConverterWidget::widget() ?>
        </div>

    </div>

</div>



