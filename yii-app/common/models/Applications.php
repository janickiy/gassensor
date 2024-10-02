<?php

namespace common\models;

use common\models\base\ApplicationsBase;
use common\models\base\ApplicationsBaseQuery;

class Applications extends ApplicationsBase
{
    public static function find()
    {
        return new ApplicationsBaseQuery(get_called_class());
    }
}