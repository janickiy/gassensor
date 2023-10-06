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


