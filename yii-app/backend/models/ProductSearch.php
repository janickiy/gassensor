<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;


/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    public $gaz_id;

    public $gaz_group_id;

    public $resolution_from;

    public $resolution_to;

    public $response_time_from;

    public $response_time_to;

    public $gaz_title;

    public $manufacture_title;

    public $measurement_type_name;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'manufacture_id', 'measurement_type_id',
                'formfactor', 'range_from', 'range_to', 'response_time',
                'energy_consumption_from', 'energy_consumption_to', 'temperature_range_from',
                'temperature_range_to'], 'integer'],

            [['price', 'resolution'], 'number'],

            [['resolution_from', 'resolution_to'], 'number'],
            [['gaz_id', 'gaz_group_id', 'measurement_type_id',
                'response_time_from', 'response_time_to',
            ], 'integer'],

            [['name', 'img', 'slug', 'range_unit', 'sensitivity_unit', 'sensitivity',
                'gaz_title', 'manufacture_title', 'measurement_type_name',], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        $labels['gaz_id'] = 'Газ';
        $labels['gaz_group_id'] = 'Группа газов';
        $labels['resolution_from'] = 'От';
        $labels['resolution_to'] = 'До';
        $labels['response_time_from'] = 'От';
        $labels['response_time_to'] = 'До';

        return $labels;
    }

    public function getDataProvider($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //$query->joinWith(['manufacture', 'gaz.gazGroups', 'measurementType',]);
        $query->joinWith(['manufacture', 'gazs.gazGroups', 'measurementType', 'productRanges']);

        $query->leftJoin('{{product_gaz}} pgm', 'product.id = pgm.product_id AND pgm.is_main = 1');
        $query->leftJoin('{{gaz}} gm', 'gm.id = pgm.gaz_id');

        $query->distinct();

        $dataProvider->sort->attributes['gaz_title'] = [
            'asc' => [
                new \yii\db\Expression("gm.title ASC"),
                'id' => SORT_ASC,
            ],
            'desc' => [
                new \yii\db\Expression("gm.title DESC"),
                'id' => SORT_DESC,
            ],
        ];

        $dataProvider->sort->attributes['manufacture_title'] = [
            'asc' => [
                new \yii\db\Expression("manufacture.title ASC"),
                'id' => SORT_ASC,
            ],
            'desc' => [
                new \yii\db\Expression("manufacture.title DESC"),
                'id' => SORT_DESC,
            ],
        ];

        $dataProvider->sort->attributes['measurement_type_name'] = [
            'asc' => [
                new \yii\db\Expression("measurement_type.name ASC"),
                'id' => SORT_ASC,
            ],
            'desc' => [
                new \yii\db\Expression("measurement_type.name DESC"),
                'id' => SORT_DESC,
            ],
        ];

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $dataProvider = $this->getDataProvider($params);
        $query = $dataProvider->query;

        // grid filtering conditions
        $query->andFilterWhere([
            'product.id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'manufacture_id' => $this->manufacture_id,
            'price' => $this->price,
            'measurement_type_id' => $this->measurement_type_id,
            'formfactor' => $this->formfactor,
            'sensitivity' => $this->sensitivity,
            'response_time' => $this->response_time,
            'energy_consumption_from' => $this->energy_consumption_from,
            'energy_consumption_to' => $this->energy_consumption_to,
            'temperature_range_from' => $this->temperature_range_from,
            'temperature_range_to' => $this->temperature_range_to,
        ]);

        $query->andFilterWhere(['like', 'product.name', $this->name])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'product.slug', $this->slug])
            ->andFilterWhere(['like', 'range_unit', $this->range_unit])
            ->andFilterWhere(['like', 'sensitivity_unit', $this->sensitivity_unit]);

        return $dataProvider;
    }

}