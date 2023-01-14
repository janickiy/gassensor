<?php
/**
 * generated 2021-11-16 17:41:24
 */

namespace common\models\base;

use Yii;

use common\models\GazGroup;
use common\models\GazToGroup;
use common\models\ProductGaz;
use common\models\Product;

/**
 * This is the model class for table "gaz".
 *
 * @property integer $id
 * @property string $title
 * @property double $weight
 * @property string $chemical_formula
 * @property string $chemical_formula_html
 * @property string $slug
 * @property string $description
 *
 * @property GazGroup[] $gazGroups
 * @property GazToGroup[] $gazToGroups
 * @property ProductGaz[] $productGazs
 * @property Product[] $products
 */
class GazBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gaz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'weight'], 'required'],
            [['weight'], 'number'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 40],
            [['chemical_formula'], 'string', 'max' => 20],
            [['chemical_formula_html'], 'string', 'max' => 60],
            [['slug'], 'string', 'max' => 100],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'weight' => Yii::t('app', 'Weight'),
            'chemical_formula' => Yii::t('app', 'Chemical Formula'),
            'chemical_formula_html' => Yii::t('app', 'Chemical Formula Html'),
            'slug' => Yii::t('app', 'Slug'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGazGroups()
    {
        return $this->hasMany(GazGroup::class, ['id' => 'gaz_group_id'])->viaTable('gaz_to_group', ['gaz_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGazToGroups()
    {
        return $this->hasMany(GazToGroup::class, ['gaz_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductGazs()
    {
        return $this->hasMany(ProductGaz::class, ['gaz_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])->viaTable('product_gaz', ['gaz_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return GazBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GazBaseQuery(get_called_class());
    }
}
