<?php

namespace frontend\controllers;

use common\models\News;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ListView;

class NewsController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->orderBy('date DESC'),
            'pagination' => [
                'pageSize' => 8,
                'pageSizeParam' => false
            ],
        ]);

        $listView = new ListView([
            'dataProvider' => $dataProvider,
        ]);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'listView' => $listView,
        ]);
    }

    /**
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSlug(string $slug)
    {
        if (!$model = News::findOne(['slug' => $slug])) {
            throw new NotFoundHttpException('not found');
        }

        return $this->render($this->action->id, compact('model'));
    }
}

