<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[ProductRangeBase]].
 *
 * @see ProductRangeBase
 */
class ProductRangeBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProductRangeBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductRangeBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
