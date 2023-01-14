<?php
/**
 *
 * @since 2017-11-24
 */

namespace common\components;

trait ClassConstNameTrait
{
    /**
     * @param null $prefix
     * @param null $translateCategory
     * @return array
     */
    public static function getClassConstNames($prefix = null, $translateCategory = null)
    {
        $rc = new \ReflectionClass(__CLASS__);
        $constants = $rc->getConstants();

        $result = [];
        foreach ($constants as $k => $v) {
            if (!empty($prefix) && strpos($k, $prefix) !== 0) {
                continue;
            }

            $result[$v] = $k;
            if (!empty($translateCategory)) {
                $result[$v] = \Yii::t($translateCategory, $result[$v]);
            }
        }

        return $result;
    }

}



