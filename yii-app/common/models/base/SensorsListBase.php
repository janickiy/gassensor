<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "sensors_list".
 *
 * @property integer $id
 * @property string $name
 * @property string $gaz
 * @property string $link
 * @property integer $count
 */
class SensorsListBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sensors_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['count'], 'integer'],
            [['name','link','gaz'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Наименование'),
            'gaz' => Yii::t('app', 'Газ'),
            'count' => Yii::t('app', 'Количество'),
            'link' => Yii::t('app', 'Ссылка'),
        ];
    }

    /**
     * @inheritdoc
     * @return SensorsListBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SensorsListBaseQuery(get_called_class());
    }
}