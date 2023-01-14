<?php
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Производители (каталог)');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seos'), 'url' => ['index']];

?>
<div class="row-fluid">

    <div class="col">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

            <!-- widget div-->
            <div>

                <h1><?= Html::encode($this->title) ?></h1>

                <br>

                <div class="table-responsive">

                    <?php Pjax::begin(); ?>

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Действия',
                                'template' => '{update}',
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action == 'update') {
                                        return Url::to(['seo/manufacture-update', 'id' => $model->id]);;
                                    }
                                }
                            ],

                            'id',
                            'created_at:dateTime',

                            [
                                'attribute' => 'slug',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a($model->slug, "/catalog/manufacture/{$model->slug}", ['target' => '_blank', 'data-pjax' => 0]);
                                }
                            ],

                            'title',

                            [
                                'attribute' => 'logo',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::img($model->getLogoUrl(), ['style' => 'max-width: 200px;']);
                                }
                            ],
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
