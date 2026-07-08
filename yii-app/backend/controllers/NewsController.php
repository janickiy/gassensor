<?php

namespace backend\controllers;

use application\News\Service\NewsService;
use application\News\Service\NewsFileService;
use application\Shared\DTO\CrudResultDto;
use common\helpers\FlashTrait;
use common\models\search\NewsSearch;
use common\models\Seo;
use modules\admin\controllers\SeoCrudController;
use Yii;

class NewsController extends SeoCrudController
{
    use FlashTrait;

    public $enableCsrfValidation = false;

    protected function serviceClass(): string
    {
        return NewsService::class;
    }

    protected function searchModelClass(): string
    {
        return NewsSearch::class;
    }

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs']['actions']['checkbox-delete'] = ['POST'];

        return $behaviors;
    }

    protected function seoType(): int
    {
        return Seo::TYPE_NEWS;
    }

    protected function createModelConfig(): array
    {
        return ['date' => date('Y-m-d')];
    }

    protected function afterSeoOwnerSaved(object $model, object $modelSeo, CrudResultDto $result, bool $isNew): void
    {
        $this->newsFileService()->uploadFromRequest($model);
    }

    protected function redirectAfterSeoSave(CrudResultDto $result, bool $isNew)
    {
        if ($isNew) {
            return parent::redirectAfterSeoSave($result, $isNew);
        }

        return $this->redirect(['update', 'id' => $result->getId()]);
    }

    public function actionDeleteFile(?int $id = null, ?string $basename = null)
    {
        $model = $this->findModel((int)$id);
        $this->newsFileService()->deleteFile($model, $basename);
        $this->addFlashSuccess("Установлен файл {$basename}");

        return $this->redirect(['update', 'id' => $id]);
    }

    public function actionFixFilename(?int $id = null, ?string $basename = null)
    {
        $model = $this->findModel((int)$id);
        $filenameNew = $this->newsFileService()->fixFilename($model, $basename);
        Yii::$app->session->addFlash('success', "renamed to '{$filenameNew}'");

        return $this->redirect(['update', 'id' => $id]);
    }

    public function actionCheckboxDelete()
    {
        $selection = Yii::$app->request->post('selection');
        if (!is_array($selection) || $selection === []) {
            Yii::$app->session->setFlash('error', 'Нечего удалять!');

            return $this->redirect(['index']);
        }

        foreach ($selection as $id) {
            $this->deleteSeoForModel($this->findModel((int)$id));
        }

        $this->service()->deleteMany($selection);
        Yii::$app->session->setFlash('success', 'Выбранные данные удалены!');

        return $this->redirect(['index']);
    }

    private function newsFileService(): NewsFileService
    {
        return Yii::$container->get(NewsFileService::class);
    }
}
