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

!function(t){t(document).ready((function(){let i,e,s,o=t("#list1"),n=o.find("option"),l=o.find("option:selected"),d=t(l)[0].innerHTML,a=t("#list2"),c=a.find("option"),p=a.find("option:selected"),r=t(p)[0].innerHTML,h=t("#list3"),b=h.find("option"),f=h.find("option:selected"),u=t(f)[0].innerHTML;n.each((function(i,e){t(e)[0].innerHTML==r&&(t(e).prop("disabled",!0),t(e).attr("disabled","disabled"))})),n.each((function(i,e){t(e)[0].innerHTML==u&&(t(e).prop("disabled",!0),t(e).attr("disabled","disabled"))})),c.each((function(i,e){t(e)[0].innerHTML==d&&(t(e).prop("disabled",!0),t(e).attr("disabled","disabled"))})),c.each((function(i,e){t(e)[0].innerHTML==u&&(t(e).prop("disabled",!0),t(e).attr("disabled","disabled"))})),b.each((function(i,e){t(e)[0].innerHTML==d&&(t(e).prop("disabled",!0),t(e).attr("disabled","disabled"))})),b.each((function(i,e){t(e)[0].innerHTML==r&&(t(e).prop("disabled",!0),t(e).attr("disabled","disabled"))})),t(".form-select").each((function(){0===p[0].index&&t(this).find("option:nth-child(2)").prop("disabled",!0),0===f[0].index&&t(this).find("option:nth-child(3)").prop("disabled",!0)})),t("#list1, #list2, #list3").on("change",(function(o){let n=t(this).find("option:selected").text();if(i=t("#list1 option:selected").text(),e=t("#list2 option:selected").text(),s=t("#list3 option:selected").text(),"list1"==t(this)[0].id){t("#list2 option, #list3 option").prop("disabled",!1),t('#list2 option:contains("'+n+'")').prop("disabled",!0),t('#list3 option:contains("'+n+'")').prop("disabled",!0);let i=t("#list2 option:selected").text(),e=t("#list3 option:selected").text();t('#list2 option:contains("'+e+'")').prop("disabled",!0),t('#list3 option:contains("'+i+'")').prop("disabled",!0)}else if("list2"==t(this)[0].id){t("#list1 option, #list3 option").prop("disabled",!1),t('#list1 option:contains("'+n+'")').prop("disabled",!0),t('#list3 option:contains("'+n+'")').prop("disabled",!0);let i=t("#list1 option:selected").text(),e=t("#list3 option:selected").text();t('#list1 option:contains("'+e+'")').prop("disabled",!0),t('#list3 option:contains("'+i+'")').prop("disabled",!0)}else if("list3"==t(this)[0].id){t("#list1 option, #list2 option").prop("disabled",!1),t('#list1 option:contains("'+n+'")').prop("disabled",!0),t('#list2 option:contains("'+n+'")').prop("disabled",!0);let i=t("#list1 option:selected").text(),e=t("#list2 option:selected").text();t('#list1 option:contains("'+e+'")').prop("disabled",!0),t('#list2 option:contains("'+i+'")').prop("disabled",!0)}t(".form-select").each((function(){0===t("#list2 option:selected")[0].index?t(this).find("option:nth-child(2)").prop("disabled",!0):t(this).find("option:nth-child(2)").prop("disabled",!1),0===t("#list3 option:selected")[0].index?t(this).find("option:nth-child(3)").prop("disabled",!0):t(this).find("option:nth-child(3)").prop("disabled",!1)})),t("#list1 + .select2-container").on("click",(function(){t(".select2-results__options").find("li").each((function(){t(this).removeAttr("aria-disabled"),t(this).text()!==i&&t(this).attr("aria-selected","false"),t(this).text()!=e&&t(this).text()!=s||(t(this).attr("aria-disabled","true"),t(this).removeAttr("aria-selected"),t(this).css("color","#ccc"))}))})),t("#list2 + .select2-container").on("click",(function(){t(".select2-results__options").find("li").each((function(){t(this).removeAttr("aria-disabled"),t(this).text()!==e&&t(this).attr("aria-selected","false"),t(this).text()!=i&&t(this).text()!=s||(t(this).attr("aria-disabled","true"),t(this).removeAttr("aria-selected"),t(this).css("color","#ccc"))}))})),t("#list3 + .select2-container").on("click",(function(){t(".select2-results__options").find("li").each((function(){t(this).removeAttr("aria-disabled"),t(this).text()!==s&&t(this).attr("aria-selected","false"),t(this).text()!=i&&t(this).text()!=e||(t(this).attr("aria-disabled","true"),t(this).removeAttr("aria-selected"),t(this).css("color","#ccc"))}))}))}))}))}(jQuery);
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


