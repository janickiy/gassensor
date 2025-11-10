<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $seo common\models\Seo|null */

use common\models\Seo;
use yii\helpers\Html;

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;

if (!$seo) {
    $seo = Seo::findOne(['type' => Seo::TYPE_PAGE_CATALOG]);
    $this->title = $seo->title;
}
$seo->registerMetaTags($this);

/* @var $request \yii\web\Request */
$req = Yii::$app->request;

$js =
    <<<JS

$("select").change(function(){
    $(this).closest("form").submit();
})

$('input[type="number"]').on('change', function() {
    $(this).closest("form").submit();
});

$('input[type="text"]').on('change paste', function() {
    $(this).closest("form").submit();
});

$(window).on("scroll", function(){
	$('input[name="scroll"]').val($(window).scrollTop());
});

$(document).ready(function(){

	var p = window.location.search;

	p = p.match(new RegExp('scroll=([^&=]+)'));

	if (p) {
		window.scrollTo(0, p[1]);
	}	  

});

JS;

$this->registerJs($js, $this::POS_READY);

?>
<style>
    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #4c5d8d;
        border-color: #4c5d8d;
    }
</style>
<div class='<?= $this->context->id ?>-<?= $this->context->action->id ?> px-2'>
    <h1><?= $seo->h1 ?? $this->title ?></h1>

    <?php if ($req->get('ProductSearch')): ?>
        <?= Html::a('Сброс фильтров', '/products', ['class' => 'btn mb-2']) ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-2 col-md-3 bg-light border py-1">

            <?= $this->render('_filter', [
                'model' => $searchModel,
            ]) ?>

        </div>
        <div class="col-md-10">

            <?= $this->render('_grid', [
                'dataProvider' => $dataProvider,
                //'searchModel' => $searchModel,
            ]) ?>

        </div>


    </div>

</div>



