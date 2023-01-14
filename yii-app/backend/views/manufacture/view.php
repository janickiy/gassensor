<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Manufacture */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manufactures'), 'url' => ['index', 'sort' => 'weight,-id']];
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
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'created_at',
                        'slug',
                        'weight',
                        'title',
                        'logo',
                        'url:url',
                        'country',
                        'short_description',
                        'description:ntext',
                    ],
                ]) ?>

            </div>
        </div>
    </div>

    <div class="col">
        <h3>Картинка</h3>
        <?= Html::img($model->logoUrl, ['style' => "max-height: 100px;", 'alt' => $model->title]) ?>
    </div>

    <div class="col">
        <h3>SEO</h3>
        <?= $this->render('/seo/_sub-view', ['model' => $model->seo]) ?>
    </div>

</div>

