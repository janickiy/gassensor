<?php

use common\models\Seo;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Seo */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'type')->dropDownList(Seo::getTypeDropDownData(1), ['class' => 'form-select']) ?>
<?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'keyword')->textarea(['rows' => 6]) ?>

<?php if (0): ?>

    <?php if (Yii::$app->user->isDeveloper()): ?>

    <?php else: ?>
        <?= $form->field($model, 'ref_id')->hiddenInput()->label(false) ?>
    <?php endif; ?>

    <?php if ($model->type): ?>
        <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>
    <?php else: ?>
        <?= $form->field($model, 'type')->dropDownList(Seo::getTypeDropDownData(1), ['class' => 'form-select']) ?>
    <?php endif; ?>

<?php endif; ?>

<?= $form->field($model, 'ref_id')->textInput() ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>


