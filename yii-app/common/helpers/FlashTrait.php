<?php
/**
 *
 * @since 2020-05-20 13:26
 */
namespace common\helpers;

use Yii;

trait FlashTrait
{
    /**
     * @param $key
     * @param bool $value
     * @param bool $removeAfterAccess
     */
    public function addFlash($key, $value = true, $removeAfterAccess = true)
    {
        if (!is_scalar($value)) {
            $value = json_encode($value, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }

        /** @var $session \yii\web\Session */
        $session = Yii::$app->session;

        return $session->addFlash($key, $value, $removeAfterAccess);
    }

    /**
     * @param $data
     */
    public function addFlashSuccess($data)
    {
        return $this->addFlash('success', $data);
    }

    /**
     * @param $data
     */
    public function addFlashError($data)
    {
        return $this->addFlash('error', $data);
    }

}
