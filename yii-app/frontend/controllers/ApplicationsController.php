<?php

namespace frontend\controllers;

use common\models\Applications;
use yii\data\Pagination;
use yii\web\Controller;

class ApplicationsController extends Controller
{
    public function actionIndex()
    {
        $query = Applications::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
        $applications = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render($this->action->id, compact('applications', 'pages'));
    }
}