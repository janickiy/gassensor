<?php
/**
 * generated 22-02-07 13:59:00
 *
 */

namespace common\models;

use common\models\base\ProductRangeBase;
use common\models\query\ProductRangeQuery;
use common\models\traits\DropDownDataGroupCol;

class ProductRange extends ProductRangeBase
{
    use DropDownDataGroupCol;
    /**
     * @inheritdoc
     * @return ProductRangeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductRangeQuery(get_called_class());
    }
}