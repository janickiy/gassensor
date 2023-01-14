<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ManufactureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manufactures');
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

                            <?= Html::a(Yii::t('app', 'Create Manufacture'), ['create'], ['class' => 'btn btn-success']) ?>

                        </div>
                    </div>
                </div>

                <br>

                <div class="table-responsive">

                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['class' => 'yii\grid\ActionColumn'],

                            'id',
                            'created_at:dateTime',

                            [
                                'attribute' => 'slug',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return Html::a($model->slug, "/manufacturer/{$model->slug}", ['target' => '_blank', 'data-pjax' => 0]);
                                }
                            ],

                            'weight',
                            'title',
                            [
                                'attribute' => 'logo',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return Html::img($model->getLogoUrl(), ['style' =>'max-width: 200px;']);
                                }
                            ],
                            'url:url',
                            'country',
                            'short_description',
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