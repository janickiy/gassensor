<?php
/**
 * generated 21-10-19 13:47:38
 *
 */

namespace common\models;

use common\models\base\GazToGroupBase;
use common\models\query\GazToGroupQuery;

class GazToGroup extends GazToGroupBase
{

    /**
     * @inheritdoc
     * @return GazToGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GazToGroupQuery(get_called_class());
    }
}