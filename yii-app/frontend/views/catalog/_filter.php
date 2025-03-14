<?php

/* @var $this yii\web\View */
/* @var $model common\models\search\ProductSearch */

use common\models\Gaz;
use common\models\GazGroup;
use common\models\Manufacture;
use common\models\MeasurementType;
use common\models\ProductRange;
use frontend\helpers\CatalogFilterHelper;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$manufactureAvailableIds = CatalogFilterHelper::findAvailableManufacturesIds($model);
$manufactureOption = ['' => ['label' => ' ']];

if ($manufactureAvailableIds) {
    foreach (Manufacture::getDropDownData(true) as $id => $label) {
        if (!in_array($id, $manufactureAvailableIds) && !empty($id)) {
            $manufactureOption[$id] = ['disabled' => true];
        }
    }
}

$gazAvailableIds = CatalogFilterHelper::findAvailableGazIds($model);
$gazOption = ['' => ['label' => ' ']];

if ($gazAvailableIds) {
    foreach (Gaz::getDropDownData(true) as $id => $label) {
        if (!in_array($id, $gazAvailableIds) && !empty($id)) {
            $gazOption[$id] = ['disabled' => true];
        }
    }
}

$measurementTypeIds = CatalogFilterHelper::findAvailableMeasurementTypeIds($model);
$measurementTypeOption = ['' => ['label' => ' ']];

if ($measurementTypeIds) {
    foreach (MeasurementType::getDropDownData(true) as $id => $label) {
        if (!in_array($id, $measurementTypeIds) && !empty($id)) {
            $measurementTypeOption[$id] = ['disabled' => true];
        }
    }
}

?>

<?php $form = ActiveForm::begin(['method' => 'get', 'action' => '/catalog']); ?>

<?= $form->field($model, 'manufacture_id')->dropDownList(
    Manufacture::getDropDownData(true),
    ['class' => 'form-select', 'options' => $manufactureOption])
?>

<?= $form->field($model, 'gaz_id')->dropDownList(
    Gaz::getDropDownData(true),
    ['class' => 'form-select', 'options' => $gazOption])
?>

<?php if (0): ?>
    <?= $form->field($model, 'gaz_group_id')->dropDownList(
        GazGroup::getDropDownData(true),
        ['class' => 'form-select', 'options' => ['' => ['label' => ' ']]])
    ?>
<?php endif; ?>

<?= $form->field($model, 'measurement_type_id')->dropDownList(
    MeasurementType::getDropDownData(true),
    ['class' => 'form-select', 'options' => $measurementTypeOption])
?>

<div class="mb-3 border p-1">
    <label>Диапазон</label>

    <div class="row g-1">
        <div class="col">
            <?= $form->field($model, 'range_from')->input('number') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'range_to')->input('number') ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'range_unit')->dropDownList(
                ProductRange::getDropDownDataGroupCol('unit', true),
                ['class' => 'form-select', 'options' => ['' => ['label' => ' ']]])
            ?>
        </div>
    </div>
</div>

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

<div class="form-group">
    <?= Html::submitButton('Поиск', ['class' => 'btn mt-3 w-100']) ?>
</div>

<?php ActiveForm::end(); ?>
