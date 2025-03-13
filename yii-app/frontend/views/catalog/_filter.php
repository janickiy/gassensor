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

?>

<?php $form = ActiveForm::begin(['method' => 'get', 'action' => '/catalog']); ?>



        <div class="mb-3 field-productsearch-manufacture_id">
            <label class="form-label" for="productsearch-manufacture_id">Производитель</label>
            <select id="productsearch-manufacture_id" class="form-select" name="ProductSearch[manufacture_id]">
                <?php
                $manufactureAvailableIds = CatalogFilterHelper::findAvailableManufacturesIds($model);
                foreach (Manufacture::getDropDownData(true) as $id => $label) {?>
                    <option
                            value="<?= $id?>"
                            label="<?= $label?>"
                            <?= !in_array($id, $manufactureAvailableIds) && !empty($id) ? 'disabled' : ''?>
                            <?= $id == $model->manufacture_id ? 'selected' : ''?>
                    >
                        <?= $label?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3 field-productsearch-gaz_id">
            <label class="form-label" for="productsearch-gaz_id">Газ</label>
            <select id="productsearch-gaz_id" class="form-select" name="ProductSearch[gaz_id]">
                <?php
                $gazAvailableIds = CatalogFilterHelper::findAvailableGazIds($model);
                foreach (Gaz::getDropDownData(true) as $id => $label) {?>
                    <option
                        value="<?= $id?>"
                        label="<?= $label?>"
                        <?= !in_array($id, $gazAvailableIds) && !empty($id) ? 'disabled' : ''?>
                        <?= $id == $model->gaz_id ? 'selected' : ''?>
                    >
                        <?= $label?></option>
                <?php } ?>
            </select>
        </div>



<?php if(0): ?>
    <?= $form->field($model, 'gaz_group_id')->dropDownList(
        GazGroup::getDropDownData(true),
        ['class' => 'form-select', 'options' => ['' => ['label' => ' ']]])
    ?>
<?php endif; ?>


    <?= $form->field($model, 'measurement_type_id')->dropDownList(
        MeasurementType::getDropDownData(true),
        ['class' => 'form-select', 'options' => ['' => ['label' => ' ']]])
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

<?php if(0): ?>
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

<?php if(0): ?>
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
