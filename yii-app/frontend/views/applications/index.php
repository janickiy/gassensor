<?php
/* @var $this yii\web\View */

use common\models\Seo;

$seo = Seo::findOne(['type' => Seo::TYPE_APPLICATIONS])->registerMetaTags($this);
$this->params['breadcrumbs'][] = $this->title;

?>

<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> container'>
     <h1><?= $seo->h1 ?></h1>

    <div class="row">
        <div class="col-sm-9 col-md-6 col-lg-4">

        </div>
    </div>

</div>


