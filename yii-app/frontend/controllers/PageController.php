<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PageController extends Controller
{

    /**
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex(string $slug)
    {
        if (!in_array($slug, ['vacancy', 'contacts', 'accessories', 'privacy'])) {
            throw new NotFoundHttpException('not found');
        }

        return $this->render($slug);
    }

}