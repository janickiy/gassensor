<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[OrderBase]].
 *
 * @see OrderBase
 */
class OrderBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return OrderBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
