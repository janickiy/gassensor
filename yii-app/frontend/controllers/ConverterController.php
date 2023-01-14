<?php
/**
 *
 * @since 2021-11-17 14:27:40
 */

namespace frontend\controllers;

use yii\web\Controller;

class ConverterController extends Controller
{
    public function actionIndex()
    {
        //
        //\Yii::$app->response->format = Response::FORMAT_JSON;
        //$req = Yii::$app->request
        //Yii::$app->session->addFlash('error', Json::encode($model->errors));
        //Yii::$app->session->addFlash('success', '');
        return $this->render($this->action->id, []);
        //return $this->redirect(['index']);
        //return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }
}
