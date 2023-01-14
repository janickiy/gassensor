<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[ProductBase]].
 *
 * @see ProductBase
 */
class ProductBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProductBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
