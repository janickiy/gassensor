<?php
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Product;

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index', 'sort' => '-id',]];

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

                            <?= Html::a(Yii::t('app', 'Добавить товар'), ['create'], ['class' => 'btn btn-info btn-sm pull-left']) ?>

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
                            ['class' => 'yii\grid\ActionColumn'],
                            'id',
                            'createdUpdatedAt:raw:Создан/Изменен',
                            'name',
                            'manufacture_id:raw:id производителя',

                            Product::getManufactureTitleGridCol(),

                            Product::getGazesGridCol(true),

                            [
                                'attribute' => 'picture',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return $model->pictUrl
                                        ? Html::img($model->pictUrl, ['style' => 'max-width: 100px;'])
                                        : null;
                                }
                            ],
                            'price',
                            [
                                'attribute' => 'slug',
                                'format' => 'raw',
                                'value' => function($model) {
                                    $url = $model->url;
                                    return $model->slug . '<hr/>' . Html::a($url, $url, ['target' => '_blank', 'data-pjax' => 0]);
                                }
                            ],
                            'measurement_type_id',
                            'measurementType.name:text:Measurement Type',
                            'formfactor',
                            'formfactor_unit',
                            [
                                'attribute' => 'range',
                                'label' => 'Диапазоны',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return $this->render('_ranges', ['model' => $model]);
                                }
                            ],
                            'resolution',
                            'sensitivity',
                            'sensitivity_unit',
                            'response_time:datetime',
                            'energy_consumption_from',
                            'energy_consumption_to',
                            'energy_consumption_unit',
                            'temperature_range_from',
                            'temperature_range_to',
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
