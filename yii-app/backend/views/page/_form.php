<?php
/* @var $this yii\web\View */
/* @var $model common\models\Page */

/* @var $form yii\widgets\ActiveForm */

use common\models\Page;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

$form = ActiveForm::begin(
    ['options' => ['enctype' => 'multipart/form-data',],
    ]); ?>

<?= $form->field($model, 'type')->dropDownList(Page::getTypeDropDownData(1), ['class' => 'form-select']) ?>

<?= $form->field($model, 'ref_id')->textInput() ?>

<?= $form->field($model, 'content')->textarea() ?>


    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>

<?php

$this->registerJsFile('/admin/js/plugin/ckeditor/ckeditor.js', ['position' => View::POS_END]);

$this->registerJs("$(document).ready(function () {CKEDITOR.replace('page-content', {height: '380px', startupFocus: true});CKEDITOR.config.allowedContent = true;});", View::POS_END);

?>