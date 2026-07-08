<?php

namespace backend\controllers;

use application\Site\Service\UploadService;
use Yii;
use common\helpers\FlashTrait;
use yii\filters\VerbFilter;
use yii\web\{Controller,Response};

/**
 * Site controller
 */
class SiteController extends Controller
{
    use FlashTrait;

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex(): string
    {

        //$this->addFlashSuccess('test1');
        //$this->addFlashError('test2');

        return $this->render('index');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        @Yii::$app->user->logout();

        return $this->redirect('/site/login');
    }

    public function actionUpload(): string
    {
        return $this->uploadService()->uploadFromRequestFiles($_FILES);
    }

    private function uploadService(): UploadService
    {
        return Yii::$container->get(UploadService::class);
    }
}
