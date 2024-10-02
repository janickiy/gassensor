<?php

namespace frontend\controllers;

use yii\web\Controller;

class ApplicationsController extends Controller
{
    public function actionIndex()
    {
        return $this->render($this->action->id, []);
    }
}