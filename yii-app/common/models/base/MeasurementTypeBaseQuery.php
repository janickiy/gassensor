<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[MeasurementTypeBase]].
 *
 * @see MeasurementTypeBase
 */
class MeasurementTypeBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MeasurementTypeBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MeasurementTypeBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
