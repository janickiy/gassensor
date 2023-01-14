<?php
/**
 * generated 2021-11-04 13:57:14
 */

namespace common\models\base;

use Yii;
use common\models\{Order,Product};

/**
 * This is the model class for table "order_product".
 *
 * @property integer $order_id
 * @property integer $product_id
 * @property string $product_info
 * @property integer $count
 * @property string $price
 *
 * @property Order $order
 * @property Product $product
 */
class OrderProductBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'count', 'price'], 'required'],
            [['order_id', 'product_id', 'count'], 'integer'],
            [['price'], 'number'],
            [['product_info'], 'string', 'max' => 255],
            [['order_id', 'product_id'], 'unique', 'targetAttribute' => ['order_id', 'product_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductBase::class, 'targetAttribute' => ['product_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderBase::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'product_info' => Yii::t('app', 'Product Info'),
            'count' => Yii::t('app', 'Count'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * @inheritdoc
     * @return OrderProductBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderProductBaseQuery(get_called_class());
    }
}
