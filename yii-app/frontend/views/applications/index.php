<?php
/* @var $this yii\web\View */

use common\models\Seo;
use yii\helpers\Html;

$seo = Seo::findOne(['type' => Seo::TYPE_APPLICATIONS])->registerMetaTags($this);
$this->params['breadcrumbs'][] = $this->title;

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
    <h1 class="text-center"><?= $seo->h1 ?></h1>

    <div class="row">
        <div class="col-12 col-sm-6">
            <h3>Применение газовых сенсоров</h3>

            <ul>
                <?php foreach ($applications ?? [] as $application): ?>
                    <li>
                        <?= Html::a($application->title, ['applications/slug', 'slug' => $application->slug]); ?>
                        <?php if (Yii::$app->user->isAdmin()): ?>

                            <?= Html::a('<i class="fa fa-edit m-1"></i>',
                                ['backend/applications/update',
                                    'id' => $application->id,],
                                ['class' => "btn d-inline rounded-pill",
                                    'target' => "_blank",
                                    'style' => "font-size: 0.8rem; padding: 4px; background: red;"
                                ]) ?>

                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
        <div class="col-12 col-sm-6">
            <h3>Применение газодетекторных трубок</h3>

            <ul>
                <?php foreach ($detectorTubes ?? [] as $application): ?>
                    <li>
                        <?= Html::a($application->title, ['applications/slug', 'slug' => $application->slug]); ?>
                        <?php if (Yii::$app->user->isAdmin()): ?>

                            <?= Html::a('<i class="fa fa-edit m-1"></i>',
                                ['backend/applications/update',
                                    'id' => $application->id,],
                                ['class' => "btn d-inline rounded-pill",
                                    'target' => "_blank",
                                    'style' => "font-size: 0.8rem; padding: 4px; background: red;"
                                ]) ?>

                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
</div>