<?php
/**
 * generated 22-03-22 18:18:23
 *
 */

namespace common\models;

use common\components\ClassConstNameTrait;
use common\models\base\SettingBase;
use common\models\query\SettingQuery;
use yii\behaviors\TimestampBehavior;

class Setting extends SettingBase
{
    use ClassConstNameTrait;

    const NAME_EMAIL_MANAGER_ORDER = 'EMAIL_MANAGER_ORDER';

    const NAME_PHONE = 'PHONE';

    const NAME_PHONE_2 = 'PHONE_2';

    const NAME_ADRESS = 'ADRESS';

    const NAME_EMAIL = 'EMAIL';

    /**
     * @inheritdoc
     * @return SettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SettingQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @param $name
     * @return Setting|null
     */
    public static function getModelByName($name)
    {
        return self::findOne(['name' => $name]);
    }

    /**
     * @param $name
     * @return string|null
     */
    public static function getValue($name)
    {
        $model = self::getModelByName($name);
        return empty($model) ? null : $model->value;
    }

    /**
     * @param $name
     * @param $value
     * @return bool
     */
    public static function saveValue($name, $value)
    {
        if (!$model = self::getModelByName($name)) {
            $model = new self();
        }

        $model->setAttributes([
            'name' => $name,
            'value' => $value,
            'description' => $name,
        ]);

        return $model->save();
    }

    /**
     * @return array|string|string[]
     */
    public static function getEmailManagerOrder()
    {
        $result = self::getValue(self::NAME_EMAIL_MANAGER_ORDER);
        $result = str_replace([' '], '', $result);
        return $result;
    }

    /**
     * @return string|null
     */
    public static function getPhone()
    {
        $result = self::getValue(self::NAME_PHONE);
        return $result;
    }

    /**
     * @return string|null
     */
    public static function getPhone2()
    {
        $result = self::getValue(self::NAME_PHONE_2);
        return $result;
    }

    /**
     * @return array|string|string[]|null
     */
    public static function getPhoneOnlyNumber()
    {
        $result = preg_replace("/[^,.0-9]/", '', self::getValue(self::NAME_PHONE));
        return $result;
    }

    /**
     * @return array|string|string[]|null
     */
    public static function getPhoneOnlyNumber2()
    {
        $result = preg_replace("/[^,.0-9]/", '', self::getValue(self::NAME_PHONE_2));
        return $result;
    }

    /**
     * @return string|null
     */
    public static function getAdress()
    {
        $result = self::getValue(self::NAME_ADRESS);
        return $result;
    }

    /**
     * @return string|null
     */
    public static function getEmail()
    {
        $result = self::getValue(self::NAME_EMAIL);
        return $result;
    }

}
