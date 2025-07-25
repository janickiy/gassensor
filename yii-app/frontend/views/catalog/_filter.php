<?php

/* @var $this yii\web\View */
/* @var $model common\models\search\ProductSearch */

use common\models\Gaz;
use common\models\GazGroup;
use common\models\Manufacture;
use common\models\MeasurementType;
use common\models\ProductRange;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>

<?php $form = ActiveForm::begin(['method' => 'get', 'action' => '/catalog']); ?>

<input type="hidden" name="scroll" value="">

<?= $form->field($model, 'manufacture_id')->dropDownList(
    Manufacture::getDropDownData(true),
    ['class' => 'form-select', 'options' => Manufacture::manufactureOption2($model)])
?>

<?= $form->field($model, 'gaz_id')->dropDownList(
    Gaz::getDropDownData(true),
    ['class' => 'form-select', 'options' => Gaz::gazOption2($model)])
?>

<?php if (0): ?>
    <?= $form->field($model, 'gaz_group_id')->dropDownList(
        GazGroup::getDropDownData(true),
        ['class' => 'form-select', 'options' => ['' => ['label' => ' ']]])
    ?>
<?php endif; ?>

<?= $form->field($model, 'measurement_type_id')->dropDownList(
    MeasurementType::getDropDownData(true),
    ['class' => 'form-select', 'options' => MeasurementType::measurementTypeOption2($model)])
?>

<?php if (0): ?>
    <div class="mb-3 border p-1">
        <label>Разрешение</label>

        <div class="row g-1">
            <div class="col">
                <?= $form->field($model, 'resolution_from')->input('number') ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'resolution_to')->input('number') ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<div class="mb-3 border p-1">
    <label>Время отклика</label>

    <div class="row g-1">
        <div class="col">
            <?= $form->field($model, 'response_time_from')->input('number') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'response_time_to')->input('number') ?>
        </div>
    </div>
</div>

<?php if (0): ?>
    <div class="mb-3 border p-1">
        <label>Энергопотребление</label>

        <div class="row g-1">
            <div class="col">
                <?= $form->field($model, 'energy_consumption_from')->input('number') ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'energy_consumption_to')->input('number') ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="mb-3 border p-1">
    <label>Диапазон температур</label>

    <div class="row g-1">
        <div class="col">
            <?= $form->field($model, 'temperature_range_from')->input('number') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'temperature_range_to')->input('number') ?>
        </div>
    </div>
</div>

<div class="mb-3 border p-1">
    <div class="row g-1">
        <div class="col">
            <?= $form->field($model, 'sensitivity') ?>
        </div>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Поиск', ['class' => 'btn mt-3 w-100']) ?>
</div>

<?php ActiveForm::end(); ?>
