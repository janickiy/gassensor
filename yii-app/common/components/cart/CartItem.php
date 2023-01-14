<?php
namespace common\components\cart;

use yii\base\BaseObject;

class CartItem extends BaseObject
{
    /**
     * @var \common\models\Product
     */
    public $product;

    /**
     * @var int
     */
    public $count;

}

