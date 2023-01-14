<?php
/**
 * generated 2022-03-22 18:18:23
 */

namespace common\models\base;

use Yii;


/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $name
 * @property string $value
 * @property string $description
 */
class SettingBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'value'], 'required'],
            [['description'], 'string'],
            [['name', 'value'], 'string', 'max' => 255],
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
            'updated_at' => Yii::t('app', 'Updated At'),
            'name' => Yii::t('app', 'Name'),
            'value' => Yii::t('app', 'Value'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @inheritdoc
     * @return SettingBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingBaseQuery(get_called_class());
    }
}
