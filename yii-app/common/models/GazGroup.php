<?php
/**
 * generated 21-10-19 13:44:05
 *
 */

namespace common\models;

use common\helpers\Tools;
use common\models\base\GazGroupBase;
use common\models\query\GazGroupQuery;
use yii\helpers\ArrayHelper;

class GazGroup extends GazGroupBase
{

    /**
     * @param false $isPrependEmpty
     * @return array
     */
    public static function getDropDownData($isPrependEmpty = false)
    {
        $rows = self::find()->cache(10)->all();
        $rows = ArrayHelper::map($rows, 'id', 'name');

        if ($isPrependEmpty) {
            $rows = Tools::array_unshift_assoc($rows);
        }

        return $rows;
    }


    /**
     * @inheritdoc
     * @return GazGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GazGroupQuery(get_called_class());
    }
}