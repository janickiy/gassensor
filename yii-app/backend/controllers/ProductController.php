<?php

namespace backend\controllers;

use Yii;
use common\helpers\FlashTrait;
use common\models\{ProductRange,Seo,Product,ProductGaz};
use common\models\search\ProductSearch;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\{Controller,NotFoundHttpException,UploadedFile};


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $modelSeo = new Seo(['type' => Seo::TYPE_PRODUCT,]);
        $modelProductGaz = new ProductGaz();
        $modelsRange = [new ProductRange];

        $req = $this->request;

        if ($req->isPost) {
            if ($model->load($req->post()) && $modelSeo->load($req->post()) && $modelProductGaz->load($req->post())) {
                $isValid = $model->validate();
                $isValid = $modelSeo->validate() && $isValid;

                $modelsRange = Product::createMultiple(ProductRange::class);
                Product::loadMultiple($modelsRange, $req->post());
                $isValid = Product::validateMultiple($modelsRange, ['from', 'to', 'unit']) && $isValid;

                if ($isValid) {
                    $model->save(false);
                    $modelSeo->ref_id = $model->id;
                    $modelSeo->save(false);

                    if ($model->uploadPict = UploadedFile::getInstance($model, 'uploadPict')) {
                        if (!$model->uploadPict()) {
                            $this->addFlashError('Ошибка загрузки картинки');
                        }
                    }

                    foreach (Product::getPdfIndexes() as $v) {
                        $attr = 'uploadPdf' . $v;
                        if ($model->$attr = UploadedFile::getInstance($model, $attr)) {
                            if (!$model->uploadPdf($v)) {
                                $this->addFlashError("Ошибка загрузки pdf $v");
                            }
                        }
                    }

                    $model->saveGazs($modelProductGaz->gaz_id); //select2 array $modelGaz->gaz_id

                    $model->saveMainbGaz($req->post('Product')['mainGazId']);

                    foreach ($modelsRange as $modelRange) {
                        $modelRange->product_id = $model->id;
                        $modelRange->save(false);
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelSeo = $model->seo ?: new Seo(['type' => Seo::TYPE_PRODUCT, 'ref_id' => $model->id]);
        //$modelGaz = $model->productGazs[0] ?? new ProductGaz(['product_id' => $model->id]);
        $modelProductGaz = new ProductGaz(['product_id' => $model->id]);

        $modelsRange = $model->productRanges ?: [new ProductRange];

        $req = $this->request;

        if ($req->isPost && $model->load($req->post()) && $modelSeo->load($req->post()) && $modelProductGaz->load($req->post())) {
            $isValid = $model->validate();
            $isValid = $modelSeo->validate() && $isValid;

            $oldIDs = ArrayHelper::map($modelsRange, 'id', 'id');
            $modelsRange = Product::createMultiple(ProductRange::class, $modelsRange);
            Product::loadMultiple($modelsRange, $req->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsRange, 'id', 'id')));
            $isValid = Product::validateMultiple($modelsRange, ['from', 'to', 'unit']) && $isValid;

            if ($isValid) {
                $model->save(false);
                $modelSeo->save(false);

                if ($model->uploadPict = UploadedFile::getInstance($model, 'uploadPict')) {
                    if (!$model->uploadPict()) {
                        $this->addFlashError('Ошибка загрузки картинки');
                    }
                }

                foreach (Product::getPdfIndexes() as $v) {
                    $attr = 'uploadPdf' . $v;
                    if ($model->$attr = UploadedFile::getInstance($model, $attr)) {
                        if (!$model->uploadPdf($v)) {
                            $this->addFlashError("Ошибка загрузки pdf $v (error code: {$model->$attr->error}) <a href='https://www.php.net/manual/en/features.file-upload.errors.php' target='_blank'>info</a>");
                        }
                    }
                }

                $model->saveGazs($modelProductGaz->gaz_id); //select2 array $modelProductGaz->gaz_id

                $model->saveMainbGaz($req->post('Product')['mainGazId']);

                if ($deletedIDs) {
                    ProductRange::deleteAll(['id' => $deletedIDs]);
                }
                foreach ($modelsRange as $modelRange) {
                    $modelRange->product_id = $model->id;
                    $modelRange->save(false);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $modelProductGaz->gaz_id = ArrayHelper::getColumn($model->gazs, 'id');

        return $this->render('update', compact('model', 'modelSeo', 'modelProductGaz', 'modelsRange'));
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($seo = $model->seo) {
            $seo->delete();//cascade
        }

        $model->delete();

        return $this->redirect(['index', 'sort' => '-id',]);
    }

    /**
     * @param $filename
     * @return bool|void
     */
    public function delFile($filename)
    {
        if (is_file($filename)) {
            Yii::$app->session->addFlash('success', "Удаление файла '$filename");
            if (unlink($filename)) {
                return true;
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка удаления');
            }
        } else {
            Yii::$app->session->addFlash('error', "Файл '$filename' не найден");
            return true;
        }
    }

    /**
     * @param null $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDeletePict($id = null)
    {
        $model = $this->findModel($id);
        $filename = $model->getPictPath();

        if ($this->delFile($filename)) {
            $model->img = null;
            $model->save(false);
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['index']);
    }

    /**
     * @param $id
     * @param $i
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDeletePdf($id, $i)
    {
        $i = $i ? (int)$i : '';
        $model = $this->findModel($id);
        $filename = $model->getPdfPath($i);

        if ($this->delFile($filename)) {
            $attr = 'pdf' . $i;
            $model->$attr = null;
            $model->save(false);
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
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}