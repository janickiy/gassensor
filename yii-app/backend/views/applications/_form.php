<?php
/* @var $this yii\web\View */
/* @var $model common\models\Applications */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelSeo common\models\Seo */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'content')->textarea(['rows' => '6', 'class' => 'form-control', 'id' => 'app-gas-content']) ?>
<?= $form->field($model, 'type')->radioList([ 1 => 'газовые сенсоры', 2 => 'газодетекторыне трубки' ]) ?>

<h3>SEO</h3>

<?= $this->render('/seo/_sub-form', ['model' => $modelSeo, 'form' => $form]) ?>


<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end();

$this->registerJsFile('/admin/js/plugin/ckeditor/ckeditor.js', ['position' => View::POS_END]);

$this->registerJs("$(document).ready(function () {
    CKEDITOR.replace( 'app-gas-content', {
    extraAllowedContent: 'img[title]',
    height: 380,
    startupFocus: true,
    filebrowserUploadUrl: '/upload.php',
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





