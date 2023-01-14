<?php
/**
 * generated 21-11-04 13:57:14
 *
 */

namespace common\models;

use common\models\base\OrderProductBase;
use common\models\query\OrderProductQuery;

class OrderProduct extends OrderProductBase
{

    /**
     * @inheritdoc
     * @return OrderProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderProductQuery(get_called_class());
    }
}