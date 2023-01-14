<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Seo;

/**
 * SeoSearch represents the model behind the search form of `common\models\Seo`.
 */
class SeoSearch extends Seo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ref_id', 'type'], 'integer'],
            [['h1', 'title', 'keyword', 'description'], 'safe'],
        ];
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Seo::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
