<?php
/* @var $this yii\web\View */
/* @var $model common\models\Manufacture */
/* @var $form yii\widgets\ActiveForm */

/* @var $modelSeo common\models\Seo */

use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-sm-3">
        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'weight')->textInput()->label('Вес (влияет на сортировку, больший вес "тянет" вниз)') ?>
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-3">

        <?= $form->field($model, 'short_description')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => '6', 'class' => 'form-control']) ?>

    </div>
    <div class="col-sm-3">
        <h3>Картинка</h3>
        <?= Html::img($model->logoUrl, ['style' => "max-height: 100px;", 'alt' => $model->title]) ?>
        <div class="mt-3">
            Загрузить:
            <?= $form->field($model, 'uploadPict')->fileInput(['accept' => '.jpg,.png,.gif'])->label(false) ?>
        </div>
    </div>
    <div class="col-sm-3">
        <h3>SEO</h3>

        <?= $this->render('/seo/_sub-form', ['model' => $modelSeo, 'form' => $form]) ?>

    </div>
</div>

<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end();

$this->registerJsFile('/admin/js/plugin/ckeditor/ckeditor.js', ['position' => View::POS_END]);

$this->registerJs("$(document).ready(function () {
    CKEDITOR.replace( 'manufacture-description', {
    extraAllowedContent: 'img[title]',
    height: 380,
    startupFocus: true,
    filebrowserUploadUrl: \"/upload.php\",
    on: {
       instanceReady: function() {
            this.dataProcessor.htmlFilter.addRules( {
                elements: {
                    img: function( el ) {
                       el.attributes.title = el.attributes.alt;
                    }
                }
            });            
        }
    }
    });

CKEDITOR.config.allowedContent = true;CKEDITOR.config.extraAllowedContent = 'img[title]';CKEDITOR.config.removePlugins = 'spellchecker, about, save, newpage, print, templates, scayt, flash, pagebreak, smiley,preview,find'});", View::POS_END);



?>