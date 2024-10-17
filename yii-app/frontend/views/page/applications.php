<?php
/* @var $this yii\web\View */
use common\models\Page;
use common\models\Seo;

echo $this->render('_page', [
    'title' => 'Контакты',
    'type' => Page::TYPE_CONTACT,
    'seoType' => Seo::TYPE_PAGE_CONTACT,
]);