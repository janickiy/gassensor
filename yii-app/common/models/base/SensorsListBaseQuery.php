<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[SensorsListBase]].
 *
 * @see SensorsListBase
 */
class SensorsListBaseQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return SensorsListBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SensorsListBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}