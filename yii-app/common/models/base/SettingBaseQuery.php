<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[SettingBase]].
 *
 * @see SettingBase
 */
class SettingBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SettingBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SettingBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
