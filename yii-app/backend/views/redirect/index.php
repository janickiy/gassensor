<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\RedirectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Редиректы');
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

                            <?= Html::a(Yii::t('app', 'Добавить редирект'), ['create'], ['class' => 'btn btn-info btn-sm pull-left']) ?>

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
                            'createdUpdatedAt:raw:Создано / Изменено',
                            'createdUpdatedBy:raw:Создал / Редактировал',
                            'from',
                            'to',
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
