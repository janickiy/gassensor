<?php

namespace backend\controllers;

use application\Product\Port\ProductFileManagerInterface;
use application\Product\Port\ProductRelationManagerInterface;
use application\Product\Port\SensorsImporterInterface;
use application\Product\Service\ProductService;
use application\Seo\Service\SeoService;
use application\Shared\Service\SlugService;
use Yii;
use common\helpers\FlashTrait;
use common\models\{ProductRange, Seo, Product, ProductGaz};
use backend\models\ProductSearch;
use domain\Shared\Exception\EntityNotFoundException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\{Controller, NotFoundHttpException, UploadedFile};
use yii\base\DynamicModel;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    use FlashTrait;

    public $enableCsrfValidation = false;

    /**
     * @inheritDoc
     */
    public function behaviors(): array
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex(): string
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = $this->productService()->createModel();
        $modelSeo = $this->seoService()->createModel(['type' => Seo::TYPE_PRODUCT]);
        $modelProductGaz = new ProductGaz();
        $modelsRange = [new ProductRange];

        $req = $this->request;

        if ($req->isPost) {
            if ($this->productService()->load($model, $req->post()) && $this->seoService()->load($modelSeo, $req->post()) && $modelProductGaz->load($req->post())) {
                $isValid = $this->productService()->validate($model);
                $isValid = $this->seoService()->validate($modelSeo) && $isValid;

                $modelsRange = Product::createMultiple(ProductRange::class);

                Product::loadMultiple($modelsRange, $req->post());

                $isValid = Product::validateMultiple($modelsRange, ['from', 'to', 'unit']) && $isValid;

                if ($isValid) {
                    $model->slug = $this->slugService()->normalize($model->slug);
                    $result = $this->productService()->saveModel($model);
                    $modelSeo->ref_id = $result->getId();
                    $this->seoService()->saveModel($modelSeo);

                    $this->addUploadErrors($this->productFileService()->uploadFromRequest($model));
                    $this->productRelationService()->saveCreateRelations($model, $req->post('ProductGaz', []), $modelsRange);

                    return $this->redirect(['view', 'id' => $result->getId()]);
                }
            }
        }

        return $this->render('create', compact('model', 'modelSeo', 'modelProductGaz', 'modelsRange'));
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $modelSeo = $model->seo ?: $this->seoService()->createModel(['type' => Seo::TYPE_PRODUCT, 'ref_id' => $model->id]);
        $modelProductGaz = new ProductGaz(['product_id' => $model->id]);

        $modelsRange = $model->productRanges ?: [new ProductRange];

        $req = $this->request;

        if ($req->isPost && $this->productService()->load($model, $req->post()) && $this->seoService()->load($modelSeo, $req->post()) && $modelProductGaz->load($req->post())) {
            $isValid = $this->productService()->validate($model);
            $isValid = $this->seoService()->validate($modelSeo) && $isValid;

            $modelsRange = Product::createMultiple(ProductRange::class, $modelsRange);
            Product::loadMultiple($modelsRange, $req->post());
            $isValid = Product::validateMultiple($modelsRange, ['from', 'to', 'unit']) && $isValid;

            if ($isValid) {
                $model->slug = $this->slugService()->normalize($model->slug);
                $this->productService()->saveModel($model);
                $this->seoService()->saveModel($modelSeo);

                $this->addUploadErrors($this->productFileService()->uploadFromRequest($model));
                $this->productRelationService()->saveUpdateRelations(
                    $model,
                    $req->post('ProductGaz', []),
                    $modelsRange,
                    $req->post('ProductRange', [])
                );

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $modelProductGaz->gaz_id = ArrayHelper::getColumn($model->notMainGazes, 'id');
        $modelProductGaz->is_main = $model->mainGaz->id ?? null;
        $modelProductGaz->is_main_2 = $model->mainGaz2->id ?? null;
        $modelProductGaz->is_main_3 = $model->mainGaz3->id ?? null;

        return $this->render('update', compact('model', 'modelSeo', 'modelProductGaz', 'modelsRange'));
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);

        if ($seo = $model->seo) {
            $this->seoService()->delete((int)$seo->id);
        }

        $this->productService()->delete($id);

        return $this->redirect(['index', 'sort' => '-id',]);
    }

    public function actionCheckboxDelete()
    {
        $selection = Yii::$app->request->post('selection');

        if (!is_array($selection) || $selection === []) {
            Yii::$app->session->setFlash('error', 'Нечего удалять!');

            return $this->redirect(['index', 'sort' => '-id']);
        }

        foreach ($selection as $id) {
            $model = $this->findModel((int)$id);
            if ($model->seo) {
                $this->seoService()->delete((int)$model->seo->id);
            }
        }

        $this->productService()->deleteMany($selection);
        Yii::$app->session->setFlash('success', 'Выбранные данные удалены!');

        return $this->redirect(['index', 'sort' => '-id']);
    }

    /**
     * @param null $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDeletePict(?int $id = null)
    {
        $model = $this->findModel((int)$id);
        if ($this->productFileService()->deletePict($model)) {
            Yii::$app->session->addFlash('success', 'Картинка удалена');
        } else {
            Yii::$app->session->addFlash('error', 'Ошибка удаления картинки');
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    /**
     * @param int $id
     * @param $i
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDeletePdf(int $id, ?string $i = null)
    {
        $model = $this->findModel($id);
        if ($this->productFileService()->deletePdf($model, $i)) {
            Yii::$app->session->addFlash('success', 'PDF удален');
        } else {
            Yii::$app->session->addFlash('error', 'Ошибка удаления PDF');
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): object
    {
        try {
            return $this->productService()->getModel($id);
        } catch (EntityNotFoundException $exception) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'), 0, $exception);
        }
    }

    /**
     * @param $sort
     * @return \yii\web\Response
     * @throws \yii\db\Exception
     * @throws \yii\web\RangeNotSatisfiableHttpException
     */
    public function actionExportExcel($sort = null)
    {
        return Product::exportExcel();
    }

    /**
     * Импорт сенсоров
     *
     * @return string
     */
    public function actionUploadSensors()
    {
        $modelImport = new DynamicModel([
            'file' => 'Импорт сенсоров',
        ]);
        $modelImport->addRule(['file'], 'required');
        $modelImport->addRule(['file'], 'file', ['extensions' => 'ods,xls,xlsx,csv'], ['maxSize' => 1024 * 1024]);

        if (Yii::$app->request->post()) {
            $modelImport->file = UploadedFile::getInstance($modelImport, 'file');

            if ($modelImport->file && $modelImport->validate()) {
                $count = $this->sensorsImportService()->importUploadedFile($modelImport->file);
                Yii::$app->getSession()->setFlash('success', 'Импорт успешно завершен. Импортировано: ' . $count);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Ошибка импорта');
            }
        }

        return $this->render('upload', ['model' => $modelImport]);
    }

    private function productService(): ProductService
    {
        return Yii::$container->get(ProductService::class);
    }

    private function seoService(): SeoService
    {
        return Yii::$container->get(SeoService::class);
    }

    private function productFileService(): ProductFileManagerInterface
    {
        return Yii::$container->get(ProductFileManagerInterface::class);
    }

    private function productRelationService(): ProductRelationManagerInterface
    {
        return Yii::$container->get(ProductRelationManagerInterface::class);
    }

    private function sensorsImportService(): SensorsImporterInterface
    {
        return Yii::$container->get(SensorsImporterInterface::class);
    }

    private function slugService(): SlugService
    {
        return Yii::$container->get(SlugService::class);
    }

    private function addUploadErrors(array $errors): void
    {
        foreach ($errors as $error) {
            $this->addFlashError($error);
        }
    }
}
