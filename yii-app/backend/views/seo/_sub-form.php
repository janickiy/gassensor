<?php
/* @var $this yii\web\View */
/* @var $model common\models\Seo */
/* @var $form yii\widgets\ActiveForm  */
?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'keyword')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'url_canonical')->textInput(['maxlength' => true]) ?>
