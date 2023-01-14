<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="row-fluid">

    <div class="col">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blueDark" data-widget-editbutton="false">

            <!-- widget div-->
            <div>

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a(Yii::t('app', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот элемент?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'created_at:dateTime',
                        'statusName',
                        'name',
                        'email:email',
                        'phone',
                        'delivery_info:ntext',
                        'comment:ntext',
                    ],
                ]) ?>

            </div>
        </div>
    </div>

</div>