<?php
/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */

/* @var $modelSeo common\models\Seo */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'date')->textInput() ?>
<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'content')->textarea(['rows' => '6', 'class' => 'form-control']) ?>

<h3>SEO</h3>

<?= $this->render('/seo/_sub-form', ['model' => $modelSeo, 'form' => $form]) ?>

<h2>Файлы</h2>

<?= $this->render('_files', ['model' => $model,]) ?>

<h3>Добавить</h3>

<?= $form->field($model, 'uploadFile')->fileInput() ?>

<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end();

$this->registerJsFile('/admin/js/plugin/ckeditor/ckeditor.js', ['position' => View::POS_END]);

$this->registerJs("$(document).ready(function () {CKEDITOR.replace('news-content', {height: '380px', startupFocus: true});CKEDITOR.config.allowedContent = true;CKEDITOR.config.removePlugins = 'spellchecker, about, save, newpage, print, templates, scayt, flash, pagebreak, smiley,preview,find'});", View::POS_END);

?>





