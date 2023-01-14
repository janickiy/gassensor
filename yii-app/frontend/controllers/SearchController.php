<?php
/**
 *
 * @since 2021-11-23 13:11:40
 */

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Seo;
use yii\web\BadRequestHttpException;

class SearchController extends Controller
{
    /**
     * @param null $q
     * @return string
     */
    public function actionIndex($q = null)
    {
        return $this->render($this->action->id, ['q' => $q]);
    }

    /**
     * @param null $id
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionSeo($id = null)
    {
        if (!$model = Seo::findOne($id)) {
            throw new BadRequestHttpException('bad request');
        }

        if ($url = $model->getRefUrl()) {
            return $this->redirect($url);
        }

        return 'ok';
    }
}
