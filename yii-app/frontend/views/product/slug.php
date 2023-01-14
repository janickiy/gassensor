<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $modelGaz common\models\Gaz */
/* @var $formAdd common\components\cart\AddToCartForm  */

use common\models\Product;
use frontend\assets\AppAsset;
use frontend\widgets\CartAddWidget;
use yii\bootstrap5\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => '/catalog'];

$gaz = $model->mainGaz;

if (!$gaz && $model->gazs) {
    $gaz = $model->gazs[0];
}

if ($gaz) {
    $this->params['breadcrumbs'][] = ['label' => $gaz->title, 'url' => "/catalog/{$gaz->slug}"];
}

$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('lib/yii2AjaxRequest.js', ['depends' => AppAsset::class]);

if ($seo = $model->seo) {
    $seo->registerMetaTags($this);
}

$this->params['productJsonLd'] = $model->getJsonLd();

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
     <h1><?= $seo->h1 ?? $this->title ?></h1>

<div class="row">
  <div class="col-md-4">
    <?php
      $url = $model->getPictUrl() ?: '/i/no-photo.gif';
    ?>
          <?= Html::img($url, [
              'alt' => $this->title,
              'title' => $this->title,
              'class' => 'border',
          ]) ?>
          <hr />

<?php foreach (Product::getPdfIndexes() as $v):
    if (!$url = $model->getPdfUrl($v)) {
      continue;
    }
    $attr = 'pdf' . ($v ? (int)$v : '');
?>

  <div class="mt-3 border p-2 shadow position-relative pdf-link-wrap">
    <?= Html::a('<i class="fa fa-2x fa-file-pdf"></i> ' . $model->$attr, $url, ['target' => '_blank', 'class' => 'stretched-link']) ?>
  </div>

<hr />
<?php endforeach; ?>

<div class="border my-3 p-2 bg-light">
	<?= CartAddWidget::widget(['formAdd' => $formAdd, 'model' => $model, 'hiddenCount' => false]) ?>
</div>
        <?php if (\Yii::$app->user->isAdmin()): ?>
          <div class="mt-5">
          <a href="/backend/product/update?id=<?= $model->id ?>"
            class="btn d-inline rounded-pill"
            target="_blank"
            style="font-size: 0.8rem; padding: 4px; background: red;">
            <i class="fa fa-edit m-1"></i>
          </a>
          </div>
        <?php endif; ?>

    </div>
  <div class="col-md-8">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name:text:Название',
            'manufacture.title:text:Производитель',
            //'price',

            [
                'attribute' => 'mainGaz',
                'label' => 'Основной газ',
                'format' => 'raw',
                'value' => function($model) {
                    if (!$gaz = $model->mainGaz) {
                        return;
                    }
                    return Html::a($gaz->title, "/catalog/{$gaz->slug}");
                }
            ],


            Product::getGazesGridCol(false, $model->notMainGazes),

            'measurementType.name:text:Тип измерения',

            [
                'attribute' => 'formfactor',
                'label' => 'Диаметр, мм (типоразмер)',
                'format' => 'raw',
                'value' => function($model) {
                    return $this->render('_cell-formfactor', ['model' => $model]);
                }
            ],

            [
                'attribute' => 'range',
                'label' => 'Диапазон',
                'format' => 'raw',
                'value' => function($model) {
                    return $this->render('_cell-range', ['model' => $model]);
                }
            ],
            /*[
                'attribute' => 'resolution',
                'format' => 'raw',
                'value' => function($model) {
                    return $this->render('_cell-range', ['model' => $model]);
                }
            ],*/
            [
                'attribute' => 'sensitivity',
                'format' => 'raw',
                'value' => function($model) {
                    return $this->render('_cell-sensitivity', ['model' => $model]);
                }
            ],

            [
                'attribute' => 'response_time',
                'format' => 'raw',
                'value' => function($model) {
                    return $this->render('_cell-response-time', ['model' => $model]);
                }
            ],

            [
                'attribute' => 'energy_consumption',
                'label' => 'Энергопотребление',
                'format' => 'raw',
                'value' => function($model) {
                    return $this->render('_cell-energy_consumption', ['model' => $model]);
                }
            ],

            [
                'attribute' => 'temperature_range',
                'label' => 'Температурный диапазон',
                'format' => 'raw',
                'value' => function($model) {
                    return $this->render('_cell-temperature_range', ['model' => $model]);
                }
            ],
            [
                'attribute' => 'info',
                'label' => 'Описание',
                'value' => $model->info,
                'visible' => $model->info,
            ],
        ],
    ]) ?>

    </div>
</div>


</div>


