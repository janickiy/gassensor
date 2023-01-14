<?php
/**
 *
 * @since 2021-10-16 14:56:34
 */

namespace frontend\controllers;

use yii\web\Controller;
use common\models\News;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSlug($slug)
    {
        if (!$model = News::findOne(['slug' => $slug])) {
            throw new NotFoundHttpException('not found');
        }

        return $this->render($this->action->id, compact('model'));
    }
}

