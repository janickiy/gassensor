<?php
/* @var $this yii\web\View */

use common\models\Manufacture;
use common\models\Seo;
use yii\helpers\Html;
use common\models\Page;

$this->title = 'Производители';
$this->params['breadcrumbs'][] = $this->title;

$models = Manufacture::find()->orderBy('weight, title, id asc')->all();

$seo = Seo::findOne(['type' => Seo::TYPE_MANUFACTURES])->registerMetaTags($this);

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
    <h1 class="text-center"><?= $seo->h1 ?? $this->title ?></h1>

    <?= Page::findOne(['type' => Page::TYPE_MANUFACTURE])->content ?>

    <div class="row manufactures">
        <?php foreach ($models as $model):
            $url = "/catalog/manufacture/{$model->slug}";
        ?>
        <div class="manufacture col-lg-3 col-md-4 col-sm-6">
              <div class="my-services-box">
                <div class="services-icon">
                  <a href="<?= $url ?>">
                      <?= Html::img($model->logoUrl, ['style' => "max-height: 100px;", 'loading' => "lazy", 'alt' => $model->title, 'title' => $model->title]) ?>
                  </a>
                </div>
                <div class="services-content">
                  <h3><a href="<?= $url ?>"><?= $model->title ?></a></h3>
                  <p>
                    <i class="icon ion-md-map"></i>
                    <?= $model->country ?>
                  </p>
                  <p>
                    <a href="<?= $model->url ?>">
                      <i class="icon ion-md-map"></i>
                      <?= $model->url ?>
                    </a>
                  </p>
                  <span class="description">
                    <?= $model->short_description ?>
                  </span>
                  <div>
                    <a class="post-link" href="/manufacture/<?= $model->slug ?>">
                      Подробнее<i class="icon ion-md-add-circle-outline"></i>
                    </a>
                  </div>
                </div>
              </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>


