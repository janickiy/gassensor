<?php

namespace backend\controllers;

use common\models\{Gaz,Seo};
use common\models\search\GazSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\{Controller,NotFoundHttpException};
use common\helpers\StringHelpers;

/**
 * GazController implements the CRUD actions for Gaz model.
 */
class GazController extends Controller
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
     * Lists all Gaz models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GazSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single Gaz model.
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
     * Creates a new Gaz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gaz();
        $modelSeo = new Seo(['type' => Seo::TYPE_CATALOG_GAZ]);

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

        return $this->render('create', compact('model', 'modelSeo'));
    }

    /**
     * Updates an existing Gaz model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        $modelSeo = $model->seo ?: new Seo(['type' => Seo::TYPE_CATALOG_GAZ, 'ref_id' => $model->id]);

        $req = $this->request;

        if ($req->isPost && $model->load($req->post()) && $modelSeo->load($req->post())) {
            $isValid = $model->validate();
            $isValid = $modelSeo->validate() && $isValid;

            if ($isValid) {
                $model->slug = StringHelpers::slug($model->slug);
                $model->save(false);
                $modelSeo->save(false);

                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('update', compact('model', 'modelSeo'));
    }

    /**
     * Deletes an existing Gaz model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gaz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Gaz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = Gaz::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
