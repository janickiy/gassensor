<?php

namespace common\models;

use common\models\base\ApplicationsBase;
use common\models\base\ApplicationsBaseQuery;

class Applications extends ApplicationsBase
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::class, ['ref_id' => 'id'])
            ->andOnCondition(['type' => Seo::TYPE_APPLICATIONS]);
    }

    /**
     * @return ApplicationsBaseQuery
     */
    public static function find()
    {
        return new ApplicationsBaseQuery(get_called_class());
    }
}