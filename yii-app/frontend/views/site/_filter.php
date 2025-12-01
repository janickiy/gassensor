<?php

/* @var $this yii\web\View */
/* @var $model common\models\search\ProductSearch */

use common\models\Gaz;
use common\models\Manufacture;
use common\models\MeasurementType;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>

<?php $form = ActiveForm::begin([
    'method' => 'get',
    'action' => '/catalog',
    'fieldConfig' => [
        'template' => "<div class=\"col\">{input}\n{hint}\n{error}</div>",
        'options' => ['tag' => false,]
    ],
]); ?>

    <div class="row justify-form-middle">
        <div class="col-xl-7 col-lg-12">
            <div class="row align-items-center">
                <?= $form->field($model, 'manufacture_id')->dropDownList(
                    Manufacture::getDropDownData(true),
                    ['class' => 'form-select', 'style' => 'min-width: 40px', 'options' => Manufacture::manufactureOption2($model)])->label(false)
                ?>

                <?= $form->field($model, 'gaz_id')->dropDownList(
                    Gaz::getDropDownData(true),
                    ['class' => 'form-select', 'style' => 'min-width: 40px', 'options' => Gaz::gazOption2($model)])
                ?>

                <?= $form->field($model, 'measurement_type_id')->dropDownList(
                    MeasurementType::getDropDownData(true),
                    ['class' => 'form-select', 'style' => 'min-width: 40px', 'options' => MeasurementType::measurementTypeOption2($model)])
                ?>
            </div>
        </div>

        <div class="col-xl-5 col-lg-12">
            <div class="row align-items-center">
                <div class="col-4">
                    <label class="float-end" style="font-size: 15px">Время отклика, SEC</label>
                </div>

                <?= $form->field($model, 'response_time_from')->input('number', ['style' => 'min-width: 40px; max-width: 225px;']) ?>

                <?= $form->field($model, 'response_time_to')->input('number', ['style' => 'min-width: 40px; max-width: 225px;']) ?>

                <div class="col">
                    <?= Html::submitButton('Поиск', ['class' => 'btn-form float-end']) ?>
                </div>
            </div>
        </div>






    </div>

<?php ActiveForm::end(); ?>