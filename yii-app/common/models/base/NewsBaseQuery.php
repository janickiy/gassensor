<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[NewsBase]].
 *
 * @see NewsBase
 */
class NewsBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return NewsBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NewsBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
