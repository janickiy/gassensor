<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\widgets\ActiveForm */

$params = [
    'prompt' => 'Укажите роль'
];

$roles =  Yii::$app->authManager->getRoles();
$items = ArrayHelper::map($roles, 'name', 'name');

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'firstname') ?>

<?= $form->field($model, 'lastname') ?>

<?= $form->field($model, 'patronymic') ?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'phone') ?>

<?= $form->field($model, 'role')->dropDownList($items, $params) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>