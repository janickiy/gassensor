<?php

namespace backend\controllers;

use Yii;
use common\helpers\FlashTrait;
use common\models\Setting;
use yii\web\Controller;
use yii\filters\AccessControl;

class SettingController extends Controller
{
    use FlashTrait;

    public function behaviors()
    {
        return [
            'access' => [
                'class'        => AccessControl::class,
                'only'         => ['index'],

                'rules'        => [
                    [
                        'allow'   => true,
                        'actions' => ['index'],
                        'roles'   => [ROLE_NAME_MANAGER,ROLE_NAME_ADMIN],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render($this->action->id, []);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionSave()
    {
        $req = Yii::$app->request;

        foreach ($req->post('setting') as $name => $v) {
            if (Setting::saveValue($name, $v)) {
                Yii::$app->getSession()->setFlash('success', "Сохранена настройка '$name' = '$v'");
            } else {
                Yii::$app->getSession()->setFlash('error',"Ошибка сохранения настройки '$name'");
            }
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }
}
