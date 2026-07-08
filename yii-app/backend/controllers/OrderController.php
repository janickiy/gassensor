<?php

namespace backend\controllers;

use application\Order\Service\OrderService;
use common\helpers\FlashTrait;
use common\models\Order as OrderModel;
use common\models\search\OrderSearch;
use modules\admin\controllers\BaseCrudController;
use Yii;
use yii\web\BadRequestHttpException;

class OrderController extends BaseCrudController
{
    use FlashTrait;

    protected function serviceClass(): string
    {
        return OrderService::class;
    }

    protected function searchModelClass(): string
    {
        return OrderSearch::class;
    }

    public function actionDelete(int $id)
    {
        $this->orderService()->delete($id);

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    public function actionSetStatus(int $id, int $status)
    {
        $result = $this->orderService()->setStatus($id, $status);
        $statusName = OrderModel::getStatusDropDownData()[$status] ?? $status;

        Yii::$app->getSession()->setFlash('success', "Установлен статус '{$statusName}' заказа #{$result->getId()}");

        return $this->redirect(['index', 'sort' => '-id']);
    }

    public function actionBatch()
    {
        $action = Yii::$app->request->post('action');
        $ids = json_decode((string)Yii::$app->request->post('data'), true);

        if (!$action || !is_array($ids)) {
            throw new BadRequestHttpException('invalid request');
        }

        if ($action !== 'delete') {
            throw new BadRequestHttpException('unknown action');
        }

        $count = $this->orderService()->deleteMany($ids);
        $this->addFlashSuccess("Удалено {$count} шт");

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    public function actionExportExcel($sort = null)
    {
        return OrderModel::exportExcel();
    }

    private function orderService(): OrderService
    {
        return Yii::$container->get(OrderService::class);
    }
}
