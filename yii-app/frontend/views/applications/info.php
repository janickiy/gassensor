<?php
/* @var $this yii\web\View */
/* @var $model common\models\Applications */

use common\models\Seo;

$seo = Seo::findOne(['type' => Seo::TYPE_APPLICATIONS])->registerMetaTags($this);
$this->params['breadcrumbs'][] = $this->title;

if ($seo = $model->seo) {
    $seo->registerMetaTags($this);
}

?>
