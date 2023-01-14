<?php
/**
 *  how to use: 'createdUpdatedAt:raw:Создан/Изменен',
 *
 * @since 2020-11-10 11:34
 */
namespace common\models\traits;

use Yii;

trait CreatedUpdateAtText
{
    /**
     * @param string $separator
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getCreatedUpdatedAt($separator = ' / ')
    {
        $formatter = Yii::$app->formatter;
        $result = [
            $formatter->asDateTime($this->created_at),
            $formatter->asDateTime($this->updated_at),
        ];

        return join($separator, $result);
    }

}
