<?php


namespace common\models\base;

use Yii;
use common\models\{Gaz,Product};


/**
 * This is the model class for table "product_gaz".
 *
 * @property integer $product_id
 * @property integer $gaz_id
 * @property integer $is_main
 *
 * @property Gaz $gaz
 * @property Product $product
 */
class ProductGazBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_gaz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'gaz_id'], 'required'],
            [['product_id', 'gaz_id', 'is_main'], 'integer'],
            [['product_id', 'gaz_id'], 'unique', 'targetAttribute' => ['product_id', 'gaz_id']],
            [['gaz_id'], 'exist', 'skipOnError' => true, 'targetClass' => GazBase::class, 'targetAttribute' => ['gaz_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductBase::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => Yii::t('app', 'Product ID'),
            'gaz_id' => Yii::t('app', 'Gaz ID'),
            'is_main' => Yii::t('app', 'Is Main'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGaz()
    {
        return $this->hasOne(Gaz::class, ['id' => 'gaz_id']);
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
     * @return ProductGazBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductGazBaseQuery(get_called_class());
    }
}
