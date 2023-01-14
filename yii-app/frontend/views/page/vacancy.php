<?php
/* @var $this yii\web\View */
use common\models\Page;
use common\models\Seo;

echo $this->render('_page', [
    'title' => 'Вакансии',
    'type' => Page::TYPE_VACANCY,
    'seoType' => Seo::TYPE_PAGE_VACANCY,
]);
