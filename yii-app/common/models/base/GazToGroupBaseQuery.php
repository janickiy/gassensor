<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[GazToGroupBase]].
 *
 * @see GazToGroupBase
 */
class GazToGroupBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GazToGroupBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GazToGroupBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
