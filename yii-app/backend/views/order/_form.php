<?php
/* @var $this yii\web\View */
/* @var $model common\models\Order */

/* @var $form yii\widgets\ActiveForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'delivery_info')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>


    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>


<?php ActiveForm::end(); ?>