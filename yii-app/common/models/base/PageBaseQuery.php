<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[PageBase]].
 *
 * @see PageBase
 */
class PageBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PageBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PageBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
