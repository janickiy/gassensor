<?php
/**
 *
 * @since 2020-11-10 11:34
 */
namespace common\models\traits;

use Yii;

trait CreatedUpdateByText
{
    /**
     * @param string $separator
     * @return string
     */
    public function getCreatedUpdatedBy($separator = ' / ')
    {
        $formatter = Yii::$app->formatter;
        $result = [
            $this->createdBy->username,
            $this->updatedBy->username,
        ];

        return join($separator, $result);
    }

}
