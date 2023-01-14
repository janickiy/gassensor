<?php

namespace common\models\base;

/**
 * This is the ActiveQuery class for [[UrlBase]].
 *
 * @see UrlBase
 */
class UrlBaseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UrlBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UrlBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
