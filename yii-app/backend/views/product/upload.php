<?php

/* @var $model backend\models\UploadSensorsForm */
/* @var $form yii\widgets\ActiveForm|null  */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Загрузка сенсоров');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

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

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body">

                    <h1><?= Html::encode($this->title) ?></h1>

                    <?= $form->field($model, 'file')->fileInput() ?>

                    <?= Html::submitButton(Yii::t('app', 'Импортировать'), ['class' => 'btn btn-success']) ?>

                    <?php ActiveForm::end(); ?>

                </div>

                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </div>

    </article>

</div>
