<?php
/**
 *
 * @since 2021-11-05 18:07:56
 */

namespace frontend\controllers;

use common\helpers\FlashTrait;
use common\models\Order;
use Yii;
use yii\web\Controller;

class OrderController extends Controller
{
    use FlashTrait;

    const FLASH_KEY_ORDER = 'created-order';

    /**
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status = Order::STATUS_NEW;
                if ($model->save()) {
                    //$this->addFlashSuccess("Создан заказ №{$model->id}");
                    Yii::$app->session->setFlash(self::FLASH_KEY_ORDER, $model);

                    $model->addProductsFromCart();

                    $result = $model->sendMailToManager();

                    return $this->redirect(['thanks']);
                }
            }

        } else {
            $model->loadDefaultValues();
        }


        return $this->render($this->action->id, compact('model'));
    }

    /**
     * @return string|void
     */
    public function actionThanks()
    {
        if (0) { //debug mail
            $order = Order::find()->orderBy('id DESC')->limit(1)->one();
            $result = $order->sendMailToManager();
            var_dump($result);
            exit;
        }

        $model = Yii::$app->session->getFlash(self::FLASH_KEY_ORDER);

        return $this->render($this->action->id, compact('model'));
    }
}
