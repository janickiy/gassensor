<?php

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SeoSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */


use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'SEO';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row-fluid">

    <div class="col">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

            <!-- widget div-->
            <div>

                <h1><?= Html::encode($this->title) ?></h1>

                <div class="box-header">
                    <div class="row">
                        <div class="col-md-12">

                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                            <?= $form->field($model, 'uploadedFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

                            <button>Submit</button>

                            <?php ActiveForm::end() ?>

                        </div>

                    </div>

                </div>

                <br>



            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</div>
