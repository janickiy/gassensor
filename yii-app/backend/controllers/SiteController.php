<?php

namespace backend\controllers;

use Yii;
use common\helpers\{Uploader,FlashTrait};
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
    public function behaviors()
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
    public function actions()
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
    public function actionIndex()
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
    public function actionLogout()
    {
        @Yii::$app->user->logout();

        return $this->redirect('/site/login');
    }

    public function actionUpload()
    {

        $uploader = new Uploader([
            'name' => key($_FILES),
        ]);

        $filename = $uploader->upload();

        $url = $uploader->baseUrl . '/' . basename($filename);

        return $url;
    }

}
