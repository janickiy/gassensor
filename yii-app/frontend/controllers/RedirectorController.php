<?php
/**
 *
 * @since 2021-11-13 15:10
 */
namespace frontend\controllers;

use yii\web\Controller;

class RedirectorController extends Controller
{
    /**
     * @param $url
     * @return \yii\web\Response
     */
    public function actionIndex($url)
    {
        return $this->redirect($url, 301);
    }
}
