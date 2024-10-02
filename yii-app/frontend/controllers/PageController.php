<?php
/**
 *
 * @since 2021-11-12 20:07
 */
namespace frontend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PageController extends Controller
{
    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($slug)
    {
        if (!in_array($slug, ['vacancy', 'contacts', 'accessories'])) {
            throw new NotFoundHttpException('not found');
        }

        return $this->render($slug);
    }

    public function actionApplications()
    {
        return $this->render('applications');
    }
}