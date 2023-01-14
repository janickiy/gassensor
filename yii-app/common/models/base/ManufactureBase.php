<?php
/**
 * generated 2021-10-16 18:34:36
 */

namespace common\models\base;

use Yii;


/**
 * This is the model class for table "manufacture".
 *
 * @property integer $id
 * @property integer $created_at
 * @property string $slug
 * @property integer $weight
 * @property string $title
 * @property string $logo
 * @property string $url
 * @property string $country
 * @property string $short_description
 * @property string $description
 */
class ManufactureBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'weight'], 'integer'],
            [['slug', 'title', 'logo', 'url', 'country', 'description'], 'required'],
            [['description'], 'string'],
            [['slug'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 50],
            [['logo', 'url'], 'string', 'max' => 100],
            [['country'], 'string', 'max' => 20],
            [['short_description'], 'string', 'max' => 200],
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
            'created_at' => Yii::t('app', 'Created At'),
            'slug' => Yii::t('app', 'Slug'),
            'weight' => Yii::t('app', 'Weight'),
            'title' => Yii::t('app', 'Title'),
            'logo' => Yii::t('app', 'Logo'),
            'url' => Yii::t('app', 'Url'),
            'country' => Yii::t('app', 'Country'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @inheritdoc
     * @return ManufactureBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ManufactureBaseQuery(get_called_class());
    }
}
