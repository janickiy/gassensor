<?php
/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $modelSeo common\models\Seo */
/* @var $modelProductGaz common\models\ProductGaz */

/* @var $modelsRange common\models\ProductRange[] */

use common\models\Gaz;
use common\models\Manufacture;
use common\models\MeasurementType;
use kidzen\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(['id' => 'form-product', 'options' => ['class' => 'list_opt']]); ?>

<div class="row">
    <div class="col-sm-3">
        <fieldset>
            <div class="row">
                <?= $form->field($model, 'manufacture_id')
                    ->dropDownList(
                        Manufacture::getDropDownData(true), ['class' => 'select2 itemName1', 'style' => 'width:100%']
                    )->label('Производитель*')
                ?>
            </div>
            <div class="row"> <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название*') ?></div>

            <div class="row"><?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?></div>

            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <legend>Газы</legend>

            <div class="row">

                <?= $form->field($model, 'mainGazId')
                    ->dropDownList(
                        Gaz::getDropDownData(true,), ['id' => 'list1', 'class' => 'select2 itemName2', 'style' => 'width:100%']
                    )->label("Главный 1*")
                ?>

                <?= $form->field($model, 'mainGaz2Id')
                    ->dropDownList(
                        Gaz::getDropDownData(true,), ['id' => 'list2', 'class' => 'select2 itemName2', 'style' => 'width:100%', 'prompt' => 'Выберите']
                    )->label("Главный 2")
                ?>

                <?= $form->field($model, 'mainGaz3Id')
                    ->dropDownList(
                        Gaz::getDropDownData(true,), ['id' => 'list3', 'class' => 'select2 itemName2', 'style' => 'width:100%', 'prompt' => 'Выберите']
                    )->label("Главный 3")
                ?>

                <?= $form->field($modelProductGaz, 'gaz_id')
                    ->dropDownList(
                        Gaz::getDropDownData(true,), ['class' => 'select2 itemName2', 'multiple' => 'multiple', 'style' => 'width:100%', 'id' => 'main_gaz_id', 'placeholder' => 'Поиск газа ...',]
                    )->label("Дополнительный газ")
                ?>
            </div>

            <legend></legend>

            <div class="row">
                <?= $form->field($model, 'measurement_type_id')
                    ->dropDownList(
                        MeasurementType::getDropDownData(true),
                        ['class' => 'select2 itemName1', 'style' => 'width:100%']
                    )->label("Типы измерений*")
                ?>
            </div>

            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'formfactor')->textInput() ?>
                </div>
                <div class="col">
                    <?= $form->field($model, 'formfactor_unit')->textInput() ?>
                </div>
            </div>

            <div class="row">
                <?= $form->field($model, 'resolution')->textInput() ?>
            </div>

            <div class="row">
                <?= $form->field($model, 'sensitivity')->textInput() ?>
            </div>

            <div class="row">
                <div class="col"><?= $form->field($model, 'sensitivity_from')->textInput() ?></div>
                <div class="col"><?= $form->field($model, 'sensitivity_to')->textInput() ?></div>
                <div class="col"><?= $form->field($model, 'sensitivity_unit')->textInput(['maxlength' => true])->label('Ед. изм.') ?></div>
            </div>

            <div class="row">
                <div class="col"><?= $form->field($model, 'response_time')->textInput() ?></div>
                <div class="col"><?= $form->field($model, 'response_time_unit')->textInput(['maxlength' => true])->label('Ед. изм.') ?></div>
            </div>

            <legend>Потребление энергии</legend>

            <div class="row">
                <div class="col"><?= $form->field($model, 'energy_consumption_from')->textInput() ?></div>
                <div class="col"><?= $form->field($model, 'energy_consumption_to')->textInput() ?></div>
                <div class="col"><?= $form->field($model, 'energy_consumption_unit')->textInput()->label('Ед. изм.') ?></div>
            </div>

            <legend>Диапазон температур</legend>

            <div class="row">
                <div class="col"><?= $form->field($model, 'temperature_range_from')->textInput() ?></div>
                <div class="col"><?= $form->field($model, 'temperature_range_to')->textInput() ?></div>
            </div>

            <div class="row">
                <div class="col"><?= $form->field($model, 'info')->textarea(['rows' => '3'])->label('Описание') ?></div>
            </div>

        </fieldset>
    </div>
    <div class="col-sm-3">

        <div class="col">

            <h3>Диапазоны</h3>

            <?php
            //https://github.com/kidzen/yii2-dynamicform
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                //'limit' => 4, // the maximum times, an element can be added (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsRange[0],
                'formId' => 'form-product',
                'formFields' => [
                    'from',
                    'to',
                    'unit',
                ],
            ]); ?>


            <div class="box-header">
                <div class="row">
                    <div class="col-md-12">

                        <button type="button" class="btn add-item btn-success btn-sm pull-right"><i
                                    class="fa fa-plus-circle"></i> Добавить
                        </button>

                    </div>
                </div>
            </div>

            <br>


            <div class="container-items">
                <?php foreach ($modelsRange as $i => $modelRange): ?>

                    <?php if (!$modelRange->isNewRecord): ?>
                        <?= Html::activeHiddenInput($modelRange, "[{$i}]id") ?>
                    <?php endif; ?>

                    <div class="card item row p-1 mb-2">

                        <div>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                        class="fa fa-trash-o"></i></button>
                        </div>


                        <div class="row">
                            <div class="col">
                                <?= $form->field($modelRange, "[{$i}]from")->textInput()->label('From*') ?>
                            </div>
                            <div class="col">
                                <?= $form->field($modelRange, "[{$i}]to")->textInput()->label('To*') ?>
                            </div>
                            <div class="col">
                                <?= $form->field($modelRange, "[{$i}]unit")->textInput()->label('Unit*') ?>
                            </div>
                            <div class="section">

                                <?= $form->field($modelRange, "[{$i}]pos")
                                    ->dropDownList(
                                        [0 => 'Главный газ 1', 1 => 'Главный газ 2', 2 => 'Главный газ 3'],
                                        ['class' => 'form-select']
                                    ) ?>

                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

            <?php DynamicFormWidget::end(); ?>


        </div>

    </div>
    <div class="col-sm-3">
        <div class="col">
            <h3>SEO</h3>

            <?= $this->render('/seo/_sub-form', ['model' => $modelSeo, 'form' => $form]) ?>
        </div>

    </div>

    <div class="col-sm-3">
        <?= $this->render('_files', ['model' => $model, 'form' => $form]) ?>
    </div>
</div>

<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php

$this->registerJs(
    '$(document).ready(function() {$(\'.itemName1\').select2();$(\'.itemName2\').select2({placeholder: "Поиск газа ...",});});',
    View::POS_END
);
?>


