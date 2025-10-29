<?php

namespace backend\controllers;

use common\helpers\StringHelpers;
use Yii;
use yii\web\Controller;

class AjaxController extends Controller
{
    public function actionSlug()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $q = $request->get('q');

        return [
            'slug' => StringHelpers::slug($q),
        ];
    }
}
