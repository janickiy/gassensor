<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[ManufactureBase]].
 *
 * @see ManufactureBase
 */
class ManufactureBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ManufactureBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ManufactureBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
