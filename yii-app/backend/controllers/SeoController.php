<?php

namespace backend\controllers;

use application\Manufacture\Service\ManufactureService;
use application\Seo\Service\SeoTextFileService;
use application\Seo\Service\SeoService;
use common\models\search\ManufactureSearch;
use common\models\search\SeoSearch;
use common\models\Seo as SeoModel;
use common\models\UploadSitemap;
use modules\admin\controllers\BaseCrudController;
use Yii;

class SeoController extends BaseCrudController
{
    protected function serviceClass(): string
    {
        return SeoService::class;
    }

    protected function searchModelClass(): string
    {
        return SeoSearch::class;
    }

    public function actionRobots(): string
    {
        $content = $this->seoTextFileService()->readRobots();

        return $this->render('robots', compact('content'));
    }

    public function actionUpdateRobots()
    {
        if (Yii::$app->request->post()) {
            $this->seoTextFileService()->saveRobots((string)Yii::$app->request->post('content'));
        }

        return $this->redirect(['/seo']);
    }

    public function actionGoogle(): string
    {
        $content = $this->seoTextFileService()->readGoogleUrlList();

        return $this->render('google', compact('content'));
    }

    public function actionUpdateGoogle()
    {
        if (Yii::$app->request->post()) {
            $this->seoTextFileService()->saveGoogleUrlList((string)Yii::$app->request->post('content'));
        }

        return $this->redirect(['/seo']);
    }

    public function actionSitemap(): string
    {
        return $this->render('sitemap');
    }

    public function actionUploadSitemap()
    {
        $model = new UploadSitemap();

        if (Yii::$app->request->isPost && $this->seoTextFileService()->uploadSitemapFromRequest($model)) {
            Yii::$app->session->setFlash('success', 'Файл загружен успешно');

            return $this->redirect(['seo/sitemap']);
        }

        return $this->render('sitemap-upload', compact('model'));
    }

    public function actionManufacture(): string
    {
        $searchModel = new ManufactureSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination->pageSize = 100;

        return $this->render('manufacture', compact('searchModel', 'dataProvider'));
    }

    public function actionManufactureUpdate(int $id)
    {
        $model = $this->manufactureService()->getModel($id);
        $modelSeo = $model->seo ?: $this->seoService()->createModel([
            'type' => SeoModel::TYPE_CATALOG_MANUFACTURES,
            'ref_id' => $id,
        ]);
        $modelSeo->type = $modelSeo->type ?: SeoModel::TYPE_CATALOG_MANUFACTURES;
        $modelSeo->ref_id = $id;

        if ($this->request->isPost && $this->seoService()->load($modelSeo, $this->request->post()) && $this->seoService()->validate($modelSeo)) {
            $this->seoService()->saveModel($modelSeo);

            return $this->redirect(['manufacture']);
        }

        return $this->render('manufacture-update', compact('modelSeo', 'model'));
    }

    private function seoService(): SeoService
    {
        return Yii::$container->get(SeoService::class);
    }

    private function seoTextFileService(): SeoTextFileService
    {
        return Yii::$container->get(SeoTextFileService::class);
    }

    private function manufactureService(): ManufactureService
    {
        return Yii::$container->get(ManufactureService::class);
    }
}
