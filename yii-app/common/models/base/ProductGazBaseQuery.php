<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[ProductGazBase]].
 *
 * @see ProductGazBase
 */
class ProductGazBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProductGazBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProductGazBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
