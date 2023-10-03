<?php
/**
 * generated 2022-02-07 15:01:18
 */

namespace common\models\base;

use Yii;
use common\models\Product;

/**
 * This is the model class for table "product_range".
 *
 * @property integer $id
 * @property integer $product_id
 * @property double $from
 * @property double $to
 * @property string $unit
 *
 * @property Product $product
 */
class ProductRangeBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_range';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'from', 'to', 'unit'], 'required'],
            [['product_id', 'pos'], 'integer'],
            [['from', 'to'], 'number'],
            [['unit'], 'string', 'max' => 30],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductBase::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'from' => Yii::t('app', 'From'),
            'to' => Yii::t('app', 'To'),
            'unit' => Yii::t('app', 'Unit'),
            'pos' => Yii::t('app', 'Газы'),
        ];
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
     * @return ProductRangeBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductRangeBaseQuery(get_called_class());
    }
}
