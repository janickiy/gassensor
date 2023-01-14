<?php
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UrlSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use common\models\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;


$this->title = Yii::t('app', 'Urls');
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

                            <?= Html::a(Yii::t('app', 'Добавить Url'), ['create'], ['class' => 'btn btn-info btn-sm pull-left']) ?>

                        </div>
                    </div>
                </div>

                <br>

                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',

                            [
                                'attribute' => 'url',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return Html::a($model->url, $model->url, ['target' => '_blank']);
                                }
                            ],

                            'is_nofollow:boolean',
                            'is_noindex:boolean',
                            [
                                'class' => ActionColumn::class,
                                'urlCreator' => function ($action, Url $model, $key, $index, $column) {
                                    return yii\helpers\Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>
                </div>

            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</div>




