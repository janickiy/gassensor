<?php
/* @var $this \yii\web\View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\assets\LegacyAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
LegacyAsset::register($this);

?>
<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <?= $this->render('google') ?>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?= Html::csrfMetaTags() ?>

        <title><?= defined('TITLE_PREFIX') ? TITLE_PREFIX : '' ?><?= Html::encode($this->title) ?></title>
        <?= $this->render('json-ld') ?>

        <link rel="shortcut icon" href="/i/favicon.png">

        <?php

        /* @var $request \yii\web\Request */
        $request = Yii::$app->request;
        if ($request->get('page') || $request->get('sort')) {
            $url = Url::current(['sort' => null, 'page' => null,]);
            $url = trim(preg_replace('%/index$%', '', $url), ' /');

            echo "<link rel='canonical' href='https://gassensor.ru/$url' />";
        }

        ?>

        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="site">

        <?= $this->render('header') ?>

        <div class="m-3">
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Главная', 'url' => '/',],
                'links' => $this->params['breadcrumbs'] ?? [],
            ]) ?>
        </div>

        <main class="p-2">

            <?= Alert::widget() ?>
            <?= $content ?>

        </main>

        <?= $this->render('footer') ?>

    </div>
    <?php $this->endBody() ?>

    <?php if (!defined('LOCAL_SITE')): ?>

        <?= $this->render('yandex-metrika') ?>

        <?= $this->render('googletagmanager') ?>

    <?php else: ?>
        <!--  LOCAL_SITE -->
    <?php endif; ?>
    </body>
    </html>
<?php $this->endPage() ?>