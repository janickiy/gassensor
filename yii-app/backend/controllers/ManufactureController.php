<?php

namespace backend\controllers;

use application\Manufacture\Service\ManufactureService;
use application\Manufacture\Service\ManufactureFileService;
use application\Shared\DTO\CrudResultDto;
use common\helpers\FlashTrait;
use common\models\search\ManufactureSearch;
use common\models\Seo;
use modules\admin\controllers\SeoCrudController;
use Yii;

class ManufactureController extends SeoCrudController
{
    use FlashTrait;

    protected function serviceClass(): string
    {
        return ManufactureService::class;
    }

    protected function searchModelClass(): string
    {
        return ManufactureSearch::class;
    }

    public function actionIndex(): string
    {
        $searchModel = new ManufactureSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination->pageSize = 100;

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    protected function seoType(): int
    {
        return Seo::TYPE_MANUFACTURE;
    }

    protected function afterSeoOwnerSaved(object $model, object $modelSeo, CrudResultDto $result, bool $isNew): void
    {
        if (!$this->manufactureFileService()->uploadPictFromRequest($model)) {
            $this->addFlashError('Ошибка загрузки картинки');
        }
    }

    private function manufactureFileService(): ManufactureFileService
    {
        return Yii::$container->get(ManufactureFileService::class);
    }
}
