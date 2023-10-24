<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $modelSeo common\models\Seo */
/* @var $modelProductGaz common\models\ProductGaz */
/* @var $modelsRange common\models\ProductRange[] */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Обновление товара: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['index', 'sort' => '-id',]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$js =
    <<<JS
!function(e){e(document).ready((function(){let[t,i]=[[],[]];e(".select2.itemName2").each((function(e,t){"main_gaz_id"!==t.id&&i.push(t.id)})),e(i).each((function(i,s){let l=e("#"+s),c="select2-"+s+"-results",n=l.find("option"),o=n.filter(":selected"),d=o[0].index,r=o[0].text.trim();0===d&&(r=!1),t.push({list:l,resultId:c,options:n,selected:o,selectedText:r})})),e(".form-select").each((function(){!1===t[1].selectedText&&e(this).find("option:nth-child(2)").prop("disabled",!0),!1===t[2].selectedText&&e(this).find("option:nth-child(3)").prop("disabled",!0)}));for(let i=0;i<t.length;i++){let s=t.slice();s.splice(i,1),t[i].options.each((function(e,t){s.forEach((function(e,i){e.selectedText===t.text&&(t.disabled=!0)}))})),t[i].list.on("change",(function(l){let c=e(this).find("option:selected"),n=c[0].index;selectedText=c.text().trim(),0===n?selectedText=!1:selectedText,t[i].selected=c,t[i].selectedIndex=n,t[i].selectedText=selectedText,s.forEach((function(e,t){let i=s.slice();i.splice(t,1),e.options.each((function(e,t){t.disabled=!1,t.text===selectedText&&(t.disabled=!0),t.text===i[0].selectedText&&(t.disabled=!0)}))})),e(".form-select").each((function(){!1===t[1].selectedText?e(this).find("option:nth-child(2)").prop("disabled",!0):e(this).find("option:nth-child(2)").prop("disabled",!1),!1===t[2].selectedText?e(this).find("option:nth-child(3)").prop("disabled",!0):e(this).find("option:nth-child(3)").prop("disabled",!1)}))})),t[i].list.siblings(".select2-container").on("click",(function(){let l=e(".select2-results__options"),c=e(".select2-results__option"),n=e('<li class="select2-results__unselect-option" style="color: #f00; cursor: pointer; padding: 7px 0;"> - UNSELECT - </li>'),o=e(".select2-results__unselect-option");0==o.length?l.prepend(n):o=e(".select2-results__unselect-option"),c.each((function(){let l=e(this).text().trim();for(list of(e(this).removeAttr("aria-disabled"),l===t[i].selectedText?e(this).attr("aria-selected","true"):e(this).attr("aria-selected","false"),s))l===list.selectedText&&(e(this).attr("aria-disabled","true"),e(this).removeAttr("aria-selected"),e(this).css("color","#ccc"))}))}))}e(document).on("click",".select2-results__unselect-option",(function(){let i=e(this).parent()[0].id;t.forEach((function(e,t){e.resultId===i&&e.list.val(null).trigger("change")}))}))}))}(jQuery);
JS;

$this->registerJs($js, $this::POS_READY);
?>

<!-- row -->
<div class="row">

    <!-- NEW WIDGET START -->
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
            <!-- widget options:
            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
            data-widget-colorbutton="false"
            data-widget-editbutton="false"
            data-widget-togglebutton="false"
            data-widget-deletebutton="false"
            data-widget-fullscreenbutton="false"
            data-widget-custombutton="false"
            data-widget-collapsed="true"
            data-widget-sortable="false"
            -->

            <!-- widget div-->
            <div>

                <!-- widget content -->
                <div class="widget-body">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>*-обязательные поля</p>

                    <p>
                        <?= Html::a(Yii::t('app', '<i class="fa fa-eye"></i> Просмотр'), ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a(Yii::t('app', '<i class="fa fa-trash-alt"></i> Удалить'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger mx-2',
                            'data' => [
                                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот элемент?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                        <?= Html::a(Yii::t('app', '<i class="fa fa-eye"></i> Slug'), "/product/{$model->slug}", ['class' => 'btn btn-info', 'target' => '_blank']) ?>
                    </p>

                    <?= $this->render('_form', [
                        'model' => $model,
                        'modelSeo' => $modelSeo,
                        'modelProductGaz' => $modelProductGaz,
                        'modelsRange' => $modelsRange,
                    ]) ?>

                </div>

                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </div>

    </article>

</div>


