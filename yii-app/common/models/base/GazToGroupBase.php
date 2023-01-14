<?php
/**
 * generated 2021-10-19 13:48:24
 */

namespace common\models\base;

use Yii;
use common\models\{Gaz,GazGroup};


/**
 * This is the model class for table "gaz_to_group".
 *
 * @property integer $gaz_id
 * @property integer $gaz_group_id
 *
 * @property Gaz $gaz
 * @property GazGroup $gazGroup
 */
class GazToGroupBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gaz_to_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gaz_id', 'gaz_group_id'], 'required'],
            [['gaz_id', 'gaz_group_id'], 'integer'],
            [['gaz_id', 'gaz_group_id'], 'unique', 'targetAttribute' => ['gaz_id', 'gaz_group_id']],
            [['gaz_id'], 'exist', 'skipOnError' => true, 'targetClass' => GazBase::class, 'targetAttribute' => ['gaz_id' => 'id']],
            [['gaz_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => GazGroupBase::class, 'targetAttribute' => ['gaz_group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gaz_id' => Yii::t('app', 'Gaz ID'),
            'gaz_group_id' => Yii::t('app', 'Gaz Group ID'),
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
    public function getGazGroup()
    {
        return $this->hasOne(GazGroup::class, ['id' => 'gaz_group_id']);
    }

    /**
     * @inheritdoc
     * @return GazToGroupBaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GazToGroupBaseQuery(get_called_class());
    }
}
