<?php
/* @var $this yii\web\View */
use common\models\Page;
use common\models\Seo;

echo $this->render('_page', [
    'title' => 'Политики обработки персональных данных',
    'type' => Page::TYPE_PRIVACY,
    'seoType' => Seo::TYPE_PAGE_PRIVACY,
]);
