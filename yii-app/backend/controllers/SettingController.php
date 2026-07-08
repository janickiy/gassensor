<?php

namespace backend\controllers;

use application\Setting\Service\SettingService;
use common\helpers\FlashTrait;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SettingController extends Controller
{
    use FlashTrait;

    public function behaviors(): array
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
    public function actionIndex(): string
    {
        return $this->render($this->action->id, []);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionSave()
    {
        $settings = Yii::$app->request->post('setting', []);
        if ($settings === []) {
            Yii::$app->getSession()->setFlash('error', 'Нет настроек для сохранения');

            return $this->redirect(Yii::$app->request->referrer ?: ['index']);
        }

        $count = $this->settingService()->saveValues($settings);
        Yii::$app->getSession()->setFlash('success', "Сохранено настроек: {$count}");

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    private function settingService(): SettingService
    {
        return Yii::$container->get(SettingService::class);
    }
}
