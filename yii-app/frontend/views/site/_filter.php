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

    <div class="row">

        <?= $form->field($model, 'manufacture_id')->dropDownList(
            Manufacture::getDropDownData(true),
            ['class' => 'form-select', 'options' => Manufacture::manufactureOption2($model)])->label(false)
        ?>

        <?= $form->field($model, 'gaz_id')->dropDownList(
            Gaz::getDropDownData(true),
            ['class' => 'form-select', 'options' => Gaz::gazOption2($model)])
        ?>

        <?= $form->field($model, 'measurement_type_id')->dropDownList(
            MeasurementType::getDropDownData(true),
            ['class' => 'form-select', 'options' => MeasurementType::measurementTypeOption2($model)])
        ?>

        <div class="col">
            <label>Время отклика<br>SEC</label>
        </div>

        <?= $form->field($model, 'response_time_from')->input('number') ?>

        <?= $form->field($model, 'response_time_to')->input('number') ?>

        <div class="col">
            <?= Html::submitButton('Поиск', ['class' => 'btn']) ?>
        </div>

    </div>

<?php ActiveForm::end(); ?>