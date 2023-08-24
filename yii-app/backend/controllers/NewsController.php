<?php

namespace backend\controllers;

use Yii;
use common\helpers\FlashTrait;
use common\models\{News,Seo};
use common\models\search\NewsSearch;
use yii\filters\VerbFilter;
use yii\helpers\Inflector;
use yii\web\{Controller,NotFoundHttpException,UploadedFile};
use common\helpers\StringHelpers;


/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new News(['date' => date('Y-m-d'),]);
        $modelSeo = new Seo(['type' => Seo::TYPE_NEWS,]);

        $req = $this->request;

        if ($req->isPost) {
            if ($model->load($req->post()) && $modelSeo->load($req->post())) {
                $isValid = $model->validate();

                if ($isValid) {
                    $model->slug = StringHelpers::slug($model->slug);

                    $model->save();

                    $modelSeo->ref_id = $model->id;
                    $modelSeo->save(false);

                    if ($model->uploadFile = UploadedFile::getInstance($model, 'uploadFile')) {
                        $model->upload();
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', compact('model', 'modelSeo'));
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        $modelSeo = $model->seo ?: new Seo(['type' => Seo::TYPE_NEWS, 'ref_id' => $model->id]);

        $req = $this->request;

        if ($req->isPost && $model->load($req->post()) && $modelSeo->load($req->post())) {
            $isValid = $model->validate();

            if ($isValid) {
                $model->slug = StringHelpers::slug($model->slug);

                $model->save();

                $modelSeo->save(false);

                if ($model->uploadFile = UploadedFile::getInstance($model, 'uploadFile')) {
                    $model->upload();
                }

                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('update', compact('model', 'modelSeo'));
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);

        if ($seo = $model->seo) {
            $seo->delete();//cascade
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param int|null $id
     * @param $basename
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDeleteFile(int $id = null, $basename = null)
    {
        $model = $this->findModel($id);

        $model->delFile($basename);

        $this->addFlashSuccess("Установлен файл $basename");

        return $this->redirect(['update', 'id' => $id]);

    }

    /**
     * @param int|null $id
     * @param $basename
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionFixFilename(int $id = null, $basename = null)
    {
        $model = $this->findModel($id);

        $filename = "{$model->uploadDir}/$basename";

        if (!is_file($filename)) {
            throw new \Exception('file not found');
        }

        $info = pathinfo($filename);
        $ext = $info['extension'];
        $raw = $info['filename'];

        $fixed = Inflector::slug($raw);

        $filenameNew = "{$model->uploadDir}/$fixed.$ext";

        if (rename($filename, $filenameNew)) {
            Yii::$app->session->addFlash('success', "renamed to '$filenameNew'");
        } else {
            Yii::$app->session->addFlash('error', 'fail renaming');
        }

        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
