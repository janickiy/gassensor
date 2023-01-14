<?php
/**
 * generated 2021-10-19 13:45:36
 */

namespace common\models\base;

use Yii;
use common\models\{Gaz,GazToGroup};

/**
 * This is the model class for table "gaz_group".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_ru
 *
 * @property GazToGroup[] $gazToGroups
 * @property Gaz[] $gazs
 */
class GazGroupBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gaz_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'name_ru'], 'required'],
            [['name', 'name_ru'], 'string', 'max' => 50],
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
            'name_ru' => Yii::t('app', 'Name Ru'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGazToGroups()
    {
        return $this->hasMany(GazToGroup::class, ['gaz_group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGazs()
    {
        return $this->hasMany(Gaz::class, ['id' => 'gaz_id'])->viaTable('gaz_to_group', ['gaz_group_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return GazGroupBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GazGroupBaseQuery(get_called_class());
    }
}
