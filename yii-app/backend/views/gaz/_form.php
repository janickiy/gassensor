<?php
/* @var $this yii\web\View */
/* @var $model common\models\Gaz */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelSeo common\models\Seo */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$js =
        <<<JS
 $("#gaz-slug").on("change keyup input click", function () {
     if (this.value.length >= 2) {
         let q = this.value;
         let request = $.ajax({
             url: '/backend/ajax/slug?q=' + q,
                method: "GET",
                dataType: "json"
         });
         request.done(function (data) {
             if (data.slug != null && data.slug !== '') {
                 $("#gaz-slug").val(data.slug);
             }
         });
     }
  });
JS;

$this->registerJs($js, $this::POS_READY);

?>

<?php $form = ActiveForm::begin(); ?>

<div class="col">

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'chemical_formula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chemical_formula_html')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea() ?>

</div>
<div class="col">
    <h3>SEO</h3>

    <?= $this->render('/seo/_sub-form', ['model' => $modelSeo, 'form' => $form]) ?>

</div>

<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>


<?php ActiveForm::end(); ?>


