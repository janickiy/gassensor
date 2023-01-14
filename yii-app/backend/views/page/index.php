<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\StringHelpers;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Страницы');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row-fluid">

    <div class="col">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

            <!-- widget div-->
            <div>

                <h1><?= Html::encode($this->title) ?></h1>

                <?php if (Yii::$app->user->isDeveloper()): ?>
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">

                                <?= Html::a(Yii::t('app', 'Create Page'), ['create'], ['class' => 'btn btn-info btn-sm pull-left']) ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <br>

                <div class="table-responsive">
                    <?php Pjax::begin(); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view} {update}',
                            ],
                            'id',
                            'type',
                            'typeName',
                            'ref_id',
                            [
                                'attribute' => 'content',
                                'label' => 'Контент',
                                'value' => function ($data) {
                                    return StringHelpers::shortText(StringHelpers::removeHtmlTags($data->content));
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

