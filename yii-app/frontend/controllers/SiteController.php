<?php
namespace frontend\controllers;

use common\models\LoginForm;
use common\models\SensorsList;
use frontend\models\SignupForm;
use frontend\widgets\gazConverter\GazConverterForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{

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
        $uri = $_SERVER['REQUEST_URI'];

        if ('/site/index' == $uri) {
            return $this->redirect('/', 301);
        }

        $sensorsList = SensorsList::find()->orderBy('name')->all();

        return $this->render('index', ['sensorsList' => $sensorsList]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        return 'ok';
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * @return array
     */
    public function actionGazConvert()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new GazConverterForm;

        $req = $this->request;

        $model->load($req->post());

        if (!$model->validate()) {
            return [
                'errors' => $model->errors,
            ];
        }

        if ($req->isPost && $model->load($req->post())) {

            if (!$model->validate()) {
                return $model->errors;
            }

            $model->convert();
        }

        return [
            'attributes' => $model->attributes,
        ];
    }
}

