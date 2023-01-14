<?php
/**
 * generated 2021-10-19 14:22:24
 */

namespace common\models\base;

use Yii;

use common\models\Product;

/**
 * This is the model class for table "measurement_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Product[] $products
 */
class MeasurementTypeBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'measurement_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['measurement_type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return MeasurementTypeBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MeasurementTypeBaseQuery(get_called_class());
    }
}
