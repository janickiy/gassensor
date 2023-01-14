<?php
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MeasurementTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Типы измерений');
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

                            <?= Html::a(Yii::t('app', 'Добавить тип измерений'), ['create'], ['class' => 'btn btn-info btn-sm pull-left']) ?>

                        </div>
                    </div>
                </div>

                <br>

                <div class="table-responsive">
                    <?php Pjax::begin(); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'name',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                    <?php Pjax::end(); ?>

                </div>

            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</div>