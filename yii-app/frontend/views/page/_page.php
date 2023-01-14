<?php
/* @var $this yii\web\View */
/* @var $title string */
/* @var $type string */
/* @var $seoType string */

use common\models\Page;
use common\models\Seo;

if ($seo = Seo::findOne(['type' => $seoType])) {
    $seo->registerMetaTags($this);
    $h1 = $seo->h1;
}

$this->params['breadcrumbs'][] = $this->title;

$page = Page::findOne(['type' => $type])

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
     <h1><?= $h1 ?? null ?></h1>

<?php if ($page): ?>

    <?= $page->content ?>

    <?php if (\Yii::$app->user->isAdmin()): ?>
      <div class="mt-5">
      <a href="/backend/page/update?id=<?= $page->id ?>"
        class="btn d-inline rounded-pill"
        target="_blank"
        style="font-size: 0.8rem; padding: 4px; background: red;">
        <i class="fa fa-edit m-1"></i>
      </a>
      </div>
    <?php endif; ?>

<?php else: ?>
  not found
<?php endif; ?>


</div>



