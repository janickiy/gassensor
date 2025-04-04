<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[NewsBase]].
 *
 * @see ApplicationsBase
 */
class ApplicationsBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ApplicationsBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ApplicationsBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
