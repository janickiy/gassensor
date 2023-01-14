<?php
/**
 *
 * @since 2022-02-08 12:59
 */
namespace common\models\traits;

use common\helpers\Tools;

trait DropDownDataGroupCol
{
    /**
     * @param $colname
     * @param false $isPrependEmpty
     * @return array|false
     * @throws \yii\db\Exception
     */
    public static function getDropDownDataGroupCol($colname, $isPrependEmpty = false)
    {
        $q = self::find()->select($colname)->groupBy($colname);
        //->having(['not', [$colname => null]]);
        $rows = $q->createCommand()->queryColumn();

        $rows = array_combine($rows, $rows);

        if ($isPrependEmpty) {
            $rows = Tools::array_unshift_assoc($rows);
        }

        return $rows;
    }

}
