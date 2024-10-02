<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */

use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

if ($seo = $model->seo) {
    $seo->registerMetaTags($this);
}

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
     <h1><?= $model->seo->h1 ?? $this->title ?></h1>

    <div class="single-img w-100">
        <div class="" id="news-photo-block">

        <div class="row w-100">
            <div class="col-md-4">
                    <?php
                        $url = $model->getPictUrl() ?: 'https://dummyimage.com/240x160/fff/aaa.png&text=no%20foto';
                    ?>
                    <?= Html::img($url, ['alt' => $model->title, 'loading' => "lazy", 'title' => $model->title]) ?>
            </div>
            <div class="col">

              <?php foreach (glob($model->getUploadDir() . '/*.pdf') as $filename):
                $url =  $model->getUploadUrl() . '/' . basename($filename);
              ?>
                    <div class="border m-1 p-1 rounded">
                        <a href="<?= $url ?>" target="_blank">
                          <i class="fa fa-2x fa-file-pdf"></i>
                          <?= basename($filename) ?>
                        </a>
                    </div>
              <?php endforeach; ?>

            </div>
        </div>



            <p id="news-content">
            <?= $model->content ?>
            </p>
        </div>

            <?php if (\Yii::$app->user->isAdmin()): ?>
              <div class="mt-5">
              <a href="/backend/news/update?id=<?= $model->id ?>"
                class="btn d-inline rounded-pill"
                target="_blank"
                style="font-size: 0.8rem; padding: 4px; background: red;">
                <i class="fa fa-edit m-1"></i>
              </a>
              </div>
            <?php endif; ?>

    </div>

</div>


