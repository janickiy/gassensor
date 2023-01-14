<?php

namespace backend\controllers;

use Yii;
use common\helpers\FlashTrait;
use common\models\Order;
use common\models\search\OrderSearch;
use yii\filters\VerbFilter;
use yii\web\{BadRequestHttpException,Controller,NotFoundHttpException};


/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    use FlashTrait;

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single Order model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model'));
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model'));
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    /**
     * @param $id
     * @param $status
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionSetStatus($id, $status)
    {
        $model = $this->findModel($id);

        $model->status = $status;

        if ($model->save()) {
            $this->addFlashSuccess("Установлен статус '{$model->statusName}' заказа #{$model->id}");
        } else {
            $this->addFlashError($model->errors);
        }

        return $this->redirect(['index', 'sort' => '-id']);
    }

    /**
     * @return \yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionBatch()
    {
        $req = Yii::$app->request;

        if (!$action = $req->post('action') OR !$data = json_decode($req->post('data'))) {
            throw new BadRequestHttpException('invalid request');
        }

        switch ($action) {
            case 'delete':
                $count = Order::deleteAll(['id' => $data]);
                $this->addFlashSuccess("Удалено $count шт");
                break;
            default:
                throw new BadRequestHttpException('unknown action');
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    /**
     * @param null $sort
     * @return \yii\web\Response
     */
    public function actionExportExcel($sort = null)
    {
        return Order::exportExcel();
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
