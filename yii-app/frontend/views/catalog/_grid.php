<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use common\helpers\MyDataColumn;
use common\models\Product;
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
            'label' => 'Сенсор (датчик)',
            'format' => 'raw',
            'value' => function($model) {
                /* @var $model common\models\Product */
                return Html::a($model->name, $model->url, ['target' => '_blank']);
            }
        ],

        [
            'attribute' => 'gaz_title',
            'label' => 'Газ',
            'format' => 'raw',
            'value' => function($model) {
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
            'format' => 'raw',
            'value' => function($model) {
                return $this->render('_cell-cart', ['model' => $model]);
            }
        ],

        [
            'label' => 'Диапазон',
            'class' => MyDataColumn::class,
            'tpl' => '/product/_cell-range',
        ],

        Product::getMeasurementTypeNameGridCol(),

        'formfactor:raw:Диаметр, мм (типоразмер)',

        Product::getManufactureTitleGridCol(),

        'sensitivity'

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