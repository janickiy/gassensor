<?php
/* @var $this yii\web\View */
/* @var $q string */

use common\helpers\Search;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "Результаты поиска по фразе '$q'";
$this->params['breadcrumbs'][] = $this->title;


$search = new Search(['q' => $q]);

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?>'>
     <h1><?= Html::encode($this->title) ?></h1>

<?php
    $query = $search->searchSeo();
?>

<?php if ($count = $query->count()): ?>
  <h3>Найдено в заголовках: <?= $count ?>шт</h3>
    <?php foreach ($query->all() as $v): ?>

        <?= $this->render('_snippet', [
            'q' => $q,
            'url' => Url::toRoute(['search/seo', 'id' => $v->id]),
            'texts' => [$v->h1, $v->title],
        ]) ?>

    <?php endforeach; ?>
<?php endif; ?>

<?php
    $query = $search->searchProduct();
?>

<?php if ($count = $query->count()): ?>
  <h3>Найдено в товарах: <?= $count ?>шт</h3>
    <?php foreach ($query->all() as $v): ?>

        <?= $this->render('_snippet', [
            'q' => $q,
            'url' => $v->url,
            'texts' => [$v->name, $v->pdf],
        ]) ?>

    <?php endforeach; ?>
<?php endif; ?>

<?php
    $query = $search->searchNews();
?>

<?php if ($count = $query->count()): ?>
  <h3>Найдено в новостях: <?= $count ?>шт</h3>
    <?php foreach ($query->all() as $v): ?>

        <?= $this->render('_snippet', [
            'q' => $q,
            'url' => "/news/{$v->slug}",
            'texts' => [$v->title, $v->content],
        ]) ?>

    <?php endforeach; ?>
<?php endif; ?>


</div>



