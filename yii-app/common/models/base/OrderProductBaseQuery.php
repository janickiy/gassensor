<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[OrderProductBase]].
 *
 * @see OrderProductBase
 */
class OrderProductBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return OrderProductBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OrderProductBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
