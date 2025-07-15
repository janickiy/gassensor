<?php

namespace common\models;

use common\models\base\SensorsListBase;
use common\models\query\SensorsListQuery;

class SensorsList extends SensorsListBase
{
    /**
     * @inheritdoc
     * @return SensorsListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SensorsListQuery(get_called_class());
    }
}