<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[GazBase]].
 *
 * @see GazBase
 */
class GazBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GazBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GazBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
