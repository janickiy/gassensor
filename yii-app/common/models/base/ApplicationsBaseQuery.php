<?php

namespace common\models\base;


/**
 * This is the ActiveQuery class for [[ApplicationsBase]].
 *
 * @see GazGroupBase
 */
class ApplicationsBaseQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return ApplicationsBase[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ApplicationsBase|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}