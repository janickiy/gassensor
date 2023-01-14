<?php


namespace common\models\base;

use Yii;

use common\models\OrderProduct;
use common\models\Product;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $delivery_info
 * @property string $comment
 *
 * @property OrderProduct[] $orderProducts
 * @property Product[] $products
 */
class OrderBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'status'], 'integer'],
            [['status', 'name', 'phone', 'email'], 'required'],
            [['delivery_info', 'comment'], 'string'],
            [['name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'delivery_info' => Yii::t('app', 'Delivery Info'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('order_product', ['order_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return OrderBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderBaseQuery(get_called_class());
    }
}
