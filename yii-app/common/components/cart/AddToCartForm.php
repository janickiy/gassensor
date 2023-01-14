<?php
/**
 *
 * @since 2021-11-05 15:11
 */
namespace common\components\cart;

use common\models\Product;
use Yii;
use yii\base\Model;

class AddToCartForm extends Model
{
    public $productId;

    public $count;

    public function rules()
    {
        return [
            [['productId', 'count'], 'required'],
            [['productId'], 'exist', 'skipOnError' => true,
                'targetClass' => Product::class,
                'targetAttribute' => ['productId' => 'id']],
            [['count'], 'compare', 'compareValue' => 0, 'operator' => '>'],
        ];
    }

    public function getProduct()
    {
        if ($this->productId) {
            return Product::findOne($this->productId);
        }
    }

    public function addToCart()
    {
        /* @var \common\components\cart\Cart $cart */
        $cart = Yii::$app->cart;
        $cart->addItem(Product::findOne($this->productId), $this->count);
    }

}
