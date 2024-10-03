<?php

namespace frontend\controllers;

use common\models\Applications;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ApplicationsController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $query = Applications::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 5]);
        $applications = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render($this->action->id, compact('applications', 'pages'));
    }

    /**
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSlug(string $slug)
    {
        if (!$model = Applications::findOne(['slug' => $slug])) {
            throw new NotFoundHttpException('Страница не найдена');
        }

        return $this->render($this->action->id, compact('model'));
    }
}