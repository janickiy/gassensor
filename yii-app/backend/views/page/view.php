<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helpers\StringHelpers;

/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = 'Просмотр страницы';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Страницы'), 'url' => ['index']];
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

                    <?php if (Yii::$app->user->isDeveloper()): ?>

                        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Вы уверены, что хотите удалить этот элемент?'),
                                'method' => 'post',
                            ],
                        ]) ?>

                    <?php endif; ?>

                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'type',
                        'ref_id',
                        [
                            'attribute' => 'content',
                            'label' => 'Контент',
                            'value' => function($data){
                                return StringHelpers::shortText(StringHelpers::removeHtmlTags($data->content));
                            }
                        ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
