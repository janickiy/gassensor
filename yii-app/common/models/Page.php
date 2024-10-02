<?php
/**
 * generated 21-11-17 15:33:42
 *
 */

namespace common\models;

use common\components\ClassConstNameTrait;
use common\helpers\Tools;
use common\models\base\PageBase;
use common\models\query\PageQuery;

class Page extends PageBase
{
    use ClassConstNameTrait;

    const TYPE_MANUFACTURE = 100;
    const TYPE_CONTACT = 200;
    const TYPE_CONVERTER = 300;
    const TYPE_VACANCY = 400;
    const TYPE_ACCESSORIES = 500;

    const TYPE_APPLICATIONS = 600;

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['type', 'in', 'range' => array_keys(self::getTypeDropDownData())],
        ]);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
             return false;
        }

        if (!$this->isReferable()) {
            $this->ref_id = null;
        }
         return true;
    }

    /**
     * @inheritdoc
     * @return PageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }

    /**
     * @param false $isPrependEmpty
     * @return array
     */
    public static function getTypeDropDownData($isPrependEmpty = false)
    {
        $items = self::getClassConstNames('TYPE_');

        if ($isPrependEmpty) {
            $items = Tools::array_unshift_assoc($items);
        }

        return $items;
    }

    /**
     * @return mixed
     */
    public function getTypeName()
    {
        return self::getTypeDropDownData()[$this->type];
    }

    /**
     * @return bool
     */
    public function isReferable()
    {
        return in_array($this->type, [
            //todo
        ]);
    }

}