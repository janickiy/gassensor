<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[SeoBase]].
 *
 * @see SeoBase
 */
class SeoBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SeoBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SeoBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}