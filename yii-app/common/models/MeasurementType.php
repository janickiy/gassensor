<?php
/**
 * generated 21-10-19 14:22:24
 *
 */

namespace common\models;

use common\helpers\Tools;
use common\models\base\MeasurementTypeBase;
use common\models\query\MeasurementTypeQuery;
use yii\helpers\ArrayHelper;

class MeasurementType extends MeasurementTypeBase
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
     * @return MeasurementTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MeasurementTypeQuery(get_called_class());
    }
}