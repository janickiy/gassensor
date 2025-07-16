<?php

namespace backend\controllers;

use Yii;
use common\helpers\FlashTrait;
use common\models\{Manufacture,Seo};
use common\models\search\ManufactureSearch;
use yii\filters\VerbFilter;
use yii\web\{NotFoundHttpException,UploadedFile,Controller};
use common\helpers\StringHelpers;

/**
 * ManufactureController implements the CRUD actions for Manufacture model.
 */
class ManufactureController extends Controller
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
     * Lists all Manufacture models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManufactureSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination->pageSize = 100;

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single Manufacture model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Manufacture model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Manufacture();
        $modelSeo = new Seo(['type' => Seo::TYPE_MANUFACTURE]);

        $req = $this->request;

        if ($req->isPost) {
            if ($model->load($req->post()) && $modelSeo->load($req->post())) {
                $isValid = $model->validate();
                $isValid = $modelSeo->validate() && $isValid;

                if ($isValid) {
                    $model->slug = StringHelpers::slug($model->slug);
                    $model->save(false);
                    $modelSeo->ref_id = $model->id;
                    $modelSeo->save(false);

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelSeo' => $modelSeo,
        ]);
    }

    /**
     * Updates an existing Manufacture model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        $modelSeo = $model->seo ?: new Seo(['type' => Seo::TYPE_MANUFACTURE, 'ref_id' => $model->id]);

        $req = $this->request;

        if ($req->isPost && $model->load($req->post()) && $modelSeo->load($req->post())) {
            $isValid = $model->validate();
            $isValid = $modelSeo->validate() && $isValid;

            if ($isValid) {
                $model->slug = StringHelpers::slug($model->slug);
                $model->save(false);
                $modelSeo->save(false);

                if ($model->uploadPict = UploadedFile::getInstance($model, 'uploadPict')) {
                    if (!$model->uploadPict()) {
                        Yii::$app->getSession()->setFlash('error', 'Ошибка загрузки картинки');
                    }
                }

                Yii::$app->getSession()->setFlash('success', "Данные успешно обновлены");

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelSeo' => $modelSeo,
        ]);
    }


    /**
     * Deletes an existing Manufacture model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Manufacture model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     * @return Manufacture|null
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id)
    {
        if (($model = Manufacture::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
