<?php

namespace backend\controllers;

use Yii;
use common\helpers\FlashTrait;
use common\models\Setting;
use yii\web\Controller;

class SettingController extends Controller
{
    use FlashTrait;

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
                $this->addFlashSuccess("Сохранена настройка '$name' = '$v'");
            } else {
                $this->addFlashError("Ошибка сохранения настройки '$name'");
            }
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }
}
