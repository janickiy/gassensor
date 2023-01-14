<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[RedirectBase]].
 *
 * @see RedirectBase
 */
class RedirectBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RedirectBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RedirectBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
