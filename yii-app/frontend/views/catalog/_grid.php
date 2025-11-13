<?php
/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

use common\helpers\MyDataColumn;
use common\models\Product;
use common\helpers\Tools;
use yii\grid\GridView;
use yii\helpers\Html;

?>

<div class="table-responsive">
    <?= GridView::widget([

            'dataProvider' => $dataProvider,
            'columns' => [

                //'id',
                    [
                            'attribute' => 'name',
                            'headerOptions' => ['style' => 'text-align:center;'],
                            'label' => 'Сенсор (датчик)',
                            'format' => 'raw',
                            'value' => function ($model) {
                                /* @var $model common\models\Product */
                                return Html::a($model->name, $model->url, ['target' => '_blank']);
                            }
                    ],

                    [
                            'attribute' => 'gaz_title',
                            'headerOptions' => ['style' => 'text-align:center;'],
                            'label' => 'Газ',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $result = '';
                                if ($mainGaz = $model->mainGaz) {
                                    $label = $mainGaz->title;
                                    //$result .= Html::a($label, "/catalog/{$mainGaz->slug}", ['class' => 'px-1 gaz main']);
                                    $result .= Html::tag('div', "<b>$label</b>");
                                    $result .= '<br/>';
                                }
                                $arr = Product::getGazesGridCol();
                                $result .= $arr['value']($model);

                                return $result ?: null;
                            }
                    ],

                    [
                            'attribute' => 'cart',
                            'label' => 'Заказать',
                            'headerOptions' => ['style' => 'text-align:center;'],
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $this->render('_cell-cart', ['model' => $model]);
                            }
                    ],

                    [
                            'label' => 'Диапазон',
                            'headerOptions' => ['style' => 'text-align:center;'],
                            'class' => MyDataColumn::class,
                            'tpl' => '/product/_cell-range',
                    ],

                    Product::getMeasurementTypeNameGridCol(),

                    [
                            'attribute' => 'formfactor',
                            'label' => 'Диаметр, мм (типоразмер)',
                            'headerOptions' => ['style' => 'text-align:center;'],
                        //   'contentOptions' => ['style' => 'text-align:center;'],
                            'format' => 'raw',
                            'value' => function ($model) {
                                $type = Tools::checkStringType($model->formfactor);

                                if ($type == 'int' || $type == 'float') {
                                    $value = $model->formfactor;

                                    if ($type == 'float') {
                                        $value = (float)$value;
                                        $value = round($value, 1);
                                    } else {
                                        $value = $value . '.0';
                                    }

                                    return '<div class="text-end">' . $value . '</div>';
                                } else {
                                    return '<p class="text-center">' . $model->formfactor . '</p>';
                                }

                            }
                    ],

                    Product::getManufactureTitleGridCol(),

                //'img',
                //             'price',
                //             'slug',
                //             'measurement_type_id',
                //             'formfactor',
                //             'range_from',
                //             'range_to',
                //             'range_unit',
                //'resolution',
                //             'sensitivity',
                //             'sensitivity_unit',
                //'response_time',
                //'energy_consumption_from',
                //'energy_consumption_to',
                //'temperature_range_from',
                //'temperature_range_to',

            ],
    ]); ?>
</div>