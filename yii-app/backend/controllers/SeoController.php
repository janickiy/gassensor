<?php

namespace backend\controllers;

use Yii;
use common\models\search\SeoSearch;
use common\models\{search\ManufactureSearch, UploadSitemap, Seo, Manufacture};
use yii\web\{Controller,NotFoundHttpException,UploadedFile};
use yii\filters\VerbFilter;

/**
 * SeoController implements the CRUD actions for Seo model.
 */
class SeoController extends Controller
{
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
     * Lists all Seo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Редактирование robots.txt
     * @return string
     */
    public function actionRobots()
    {
        $content = file_get_contents('../../public_html/robots.txt', true);

        return $this->render('robots', compact('content'));
    }

    /**
     * Обновление robots.txt
     * @return void|\yii\web\Response
     */
    public function actionUpdateRobots()
    {
        if (\Yii::$app->request->post()) {
            $content = \Yii::$app->request->post('content');

            file_put_contents('../../public_html/robots.txt', $content);

            return $this->redirect(['/seo']);
        }
    }

    /**
     * @return string
     */
    public function actionSitemap()
    {
        return $this->render('sitemap');
    }

    /**
     * @return string|void
     */
    public function actionUploadSitemap()
    {
        $model = new UploadSitemap();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                Yii::$app->session->setFlash('success', 'Файл загружен успешно');

                return $this->redirect(['seo/sitemap']);
            }
        }

        return $this->render('sitemap-upload', compact('model'));
    }

    /**
     * Displays a single Seo model.
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
     * Creates a new Seo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Seo();

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
     * Updates an existing Seo model.
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
     * Deletes an existing Seo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionManufacture()
    {
        $searchModel = new ManufactureSearch();

        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->pagination->pageSize = 100;

        return $this->render('manufacture', compact('searchModel', 'dataProvider'));

    }

    /**
     * @param $id
     * @return string
     */
    public function actionManufactureUpdate($id)
    {
        $model = Manufacture::findOne($id);

        $seo = Seo::find()->where(['type' => Seo::TYPE_CATALOG_MANUFACTURES, 'ref_id' => $id])->one();

        $modelSeo = $seo ?: new Seo(['type' => Seo::TYPE_CATALOG_MANUFACTURES, 'ref_id' => $id]);

        if (!isset($modelSeo->type)) $modelSeo->type = Seo::TYPE_CATALOG_MANUFACTURES;

        $modelSeo->ref_id = $id;

        $req = $this->request;

        if ($req->isPost && $modelSeo->load($req->post())) {
            $isValid = $modelSeo->validate();

            if ($isValid) {
                $modelSeo->save(false);

                return $this->redirect(['manufacture']);
            }
        }

        return $this->render('manufacture-update', compact('modelSeo', 'model'));
    }


    /**
     * Finds the Seo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Seo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
