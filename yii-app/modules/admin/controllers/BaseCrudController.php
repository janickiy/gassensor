<?php

namespace modules\admin\controllers;

use application\Shared\DTO\CrudResultDto;
use application\Shared\Service\CrudService;
use domain\Shared\Exception\EntityNotFoundException;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

abstract class BaseCrudController extends Controller
{
    abstract protected function serviceClass(): string;

    abstract protected function searchModelClass(): string;

    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    public function actionIndex(): string
    {
        $searchModel = $this->createSearchModel();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = $this->service()->createModel();

        if ($this->request->isPost && $this->service()->load($model, $this->request->post()) && $this->service()->validate($model)) {
            $result = $this->service()->saveModel($model);

            return $this->redirectAfterSave($result);
        }

        return $this->render('create', compact('model'));
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $this->service()->load($model, $this->request->post()) && $this->service()->validate($model)) {
            $result = $this->service()->saveModel($model);
            Yii::$app->getSession()->setFlash('success', 'Данные успешно обновлены');

            return $this->redirectAfterSave($result);
        }

        return $this->render('update', compact('model'));
    }

    public function actionDelete(int $id)
    {
        $this->service()->delete($id);

        return $this->redirect(['index']);
    }

    protected function findModel(int $id): object
    {
        try {
            return $this->service()->getModel($id);
        } catch (EntityNotFoundException $exception) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'), 0, $exception);
        }
    }

    protected function service(): CrudService
    {
        $service = Yii::$container->get($this->serviceClass());
        if (!$service instanceof CrudService) {
            throw new InvalidConfigException($this->serviceClass() . ' must extend ' . CrudService::class);
        }

        return $service;
    }

    protected function createSearchModel(): object
    {
        $class = $this->searchModelClass();

        return new $class();
    }

    protected function redirectAfterSave(CrudResultDto $result)
    {
        return $this->redirect(['view', 'id' => $result->getId()]);
    }
}
