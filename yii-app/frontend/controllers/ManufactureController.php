<?php
/**
 *
 * @since 2021-10-16 14:56:34
 */

namespace frontend\controllers;

use common\models\Manufacture;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ManufactureController extends Controller
{
    public function actionIndex()
    {
        return $this->render($this->action->id, [
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSlug($slug)
    {
        if (!$model = Manufacture::findOne(['slug' => $slug])) {
            throw new NotFoundHttpException('not found');
        }

        return $this->render($this->action->id, compact('model'));
    }
}

