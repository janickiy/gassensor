<?php

/* @var $this yii\web\View */
/* @var $model common\models\search\ProductSearch */

use common\models\Gaz;
use common\models\GazGroup;
use common\models\Manufacture;
use common\models\MeasurementType;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/* @var $request \yii\web\Request */
$req = Yii::$app->request;

?>

<?php $form = ActiveForm::begin(['method' => 'get', 'action' => '/catalog', 'options' => [ 'class' => 'pt-2' ]]); ?>

<input type="hidden" name="scroll" value="">

<?= $form->field($model, 'manufacture_id')->dropDownList(
    Manufacture::getDropDownData(true),
    ['class' => 'form-select', 'options' => Manufacture::manufactureOption2($model)])->label(false)
?>

<?= $form->field($model, 'gaz_id')->dropDownList(
    Gaz::getDropDownData(true),
    ['class' => 'form-select', 'options' => Gaz::gazOption2($model)])->label(false)
?>

<?php if (0): ?>
    <?= $form->field($model, 'gaz_group_id')->dropDownList(
        GazGroup::getDropDownData(true),
        ['class' => 'form-select', 'options' => ['' => ['label' => 'выберите']]])
    ?>
<?php endif; ?>

<?= $form->field($model, 'measurement_type_id')->dropDownList(
    MeasurementType::getDropDownData(true),
    ['class' => 'form-select', 'options' => MeasurementType::measurementTypeOption2($model)])->label(false)
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
    <label>Время отклика, SEC</label>

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

<div class="form-group" style="text-align: center">

    <?= Html::submitButton('Поиск', ['class' => 'btn mt-3', 'style' => 'min-width: 50px']) ?>

    <?php if ($req->get('ProductSearch')): ?>
        <a title="Сброс фильтров" href="/products" class="btn mt-3" style="min-width: 50px"><i class="fa fa-fw fa-refresh" style="margin-left: 0px;"></i></a>
    <?php endif; ?>

</div>

<?php ActiveForm::end(); ?>
