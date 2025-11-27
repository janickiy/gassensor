<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use common\helpers\StringHelpers;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Новости');
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

                            <?= Html::a(Yii::t('app', 'Добавить новость'), ['create'], ['class' => 'btn btn-info btn-sm pull-left']) ?>

                        </div>
                    </div>
                </div>

                <br>

                <div class="table-responsive">
                    <?php Pjax::begin(); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= Html::beginForm(['news/checkbox-delete'], 'post'); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'created_at:dateTime',
                            'date:date',
                            [
                                'attribute' => 'files',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $this->render('_files', ['model' => $model,]);
                                }
                            ],
                            [
                                'attribute' => 'slug',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a($model->slug, "/news/{$model->slug}", ['target' => '_blank', 'data-pjax' => 0]);
                                }
                            ],

                            'title',
                            //'content:ntext',

                            [
                                'attribute' => 'content',
                                'label' => 'Контент',
                                'value' => function ($data) {
                                    return StringHelpers::shortText(StringHelpers::removeHtmlTags($data->content), 300);
                                }
                            ],

                            [
                                'class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function ($model) {
                                return ['value' => $model->id];
                            },
                            ],

                            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',],
                        ],
                    ]); ?>

                    <?= Html::submitButton('Удалить выбранные', ['class' => 'btn btn-danger mt-3 mb-3', 'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить данные записи? Восстановить их будет нельзя.'),]); ?>

                    <?= Html::endForm() ?>

                    <?php Pjax::end(); ?>

                </div>

            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</div>
