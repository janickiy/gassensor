<?php
/* @var $this yii\web\View */
use common\models\Page;
use common\models\Seo;

echo $this->render('_page', [
    'type' => Page::TYPE_ACCESSORIES,
    'seoType' => Seo::TYPE_PAGE_ACCESSORIES,
]);

