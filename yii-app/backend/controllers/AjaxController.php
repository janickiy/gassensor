<?php

namespace backend\controllers;

use application\Shared\Service\SlugService;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class AjaxController extends Controller
{
    public function actionSlug(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'slug' => $this->slugService()->normalize((string)$this->request->get('q')),
        ];
    }

    private function slugService(): SlugService
    {
        return Yii::$container->get(SlugService::class);
    }
}
