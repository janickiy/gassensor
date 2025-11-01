<?php

namespace frontend\controllers;


use common\models\SensorsList;
use yii\data\Pagination;
use yii\web\Controller;

class RemainsController extends Controller
{
    public function actionIndex()
    {
        $query = SensorsList::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 20, 'pageSizeParam' => false, ]);
        $sensors = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render($this->action->id, compact('sensors', 'pages'));
    }
}