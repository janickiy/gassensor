<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Seo */

$this->title = Yii::t('app', 'Редактирование производители (каталог) seo: {name}', [
'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Производители (каталог)'), 'url' => ['manufacture']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

?>

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

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($modelSeo, 'type')->hiddenInput()->label(false) ?>

                    <?= $form->field($modelSeo, 'ref_id')->hiddenInput()->label(false) ?>

                    <?= $this->render('/seo/_sub-form', ['model' => $modelSeo, 'form' => $form]) ?>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>

                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </div>

    </article>

</div>
