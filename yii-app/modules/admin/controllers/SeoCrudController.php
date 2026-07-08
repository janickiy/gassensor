<?php

namespace modules\admin\controllers;

use application\Seo\Service\SeoService;
use application\Shared\DTO\CrudResultDto;
use application\Shared\Service\SlugService;
use Yii;

abstract class SeoCrudController extends BaseCrudController
{
    abstract protected function seoType(): int;

    public function actionCreate()
    {
        $model = $this->service()->createModel($this->createModelConfig());
        $modelSeo = $this->seoService()->createModel(['type' => $this->seoType()]);

        if ($this->request->isPost && $this->loadAndValidate($model, $modelSeo)) {
            $this->normalizeSlug($model);
            $result = $this->service()->saveModel($model);
            $modelSeo->ref_id = $result->getId();
            $this->seoService()->saveModel($modelSeo);
            $this->afterSeoOwnerSaved($model, $modelSeo, $result, true);

            return $this->redirectAfterSeoSave($result, true);
        }

        return $this->render('create', compact('model', 'modelSeo'));
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $modelSeo = $model->seo ?: $this->seoService()->createModel([
            'type' => $this->seoType(),
            'ref_id' => $model->id,
        ]);

        if ($this->request->isPost && $this->loadAndValidate($model, $modelSeo)) {
            $this->normalizeSlug($model);
            $result = $this->service()->saveModel($model);
            $this->seoService()->saveModel($modelSeo);
            $this->afterSeoOwnerSaved($model, $modelSeo, $result, false);
            Yii::$app->getSession()->setFlash('success', 'Данные успешно обновлены');

            return $this->redirectAfterSeoSave($result, false);
        }

        return $this->render('update', compact('model', 'modelSeo'));
    }

    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);
        $this->deleteSeoForModel($model);
        $this->service()->delete($id);

        return $this->redirect(['index']);
    }

    protected function createModelConfig(): array
    {
        return [];
    }

    protected function loadAndValidate(object $model, object $modelSeo): bool
    {
        return $this->service()->load($model, $this->request->post())
            && $this->seoService()->load($modelSeo, $this->request->post())
            && $this->service()->validate($model)
            && $this->seoService()->validate($modelSeo);
    }

    protected function normalizeSlug(object $model): void
    {
        $model->slug = $this->slugService()->normalize($this->slugSource($model));
    }

    protected function slugSource(object $model): string
    {
        return (string)($model->slug ?? '');
    }

    protected function afterSeoOwnerSaved(object $model, object $modelSeo, CrudResultDto $result, bool $isNew): void
    {
    }

    protected function redirectAfterSeoSave(CrudResultDto $result, bool $isNew)
    {
        return $this->redirectAfterSave($result);
    }

    protected function deleteSeoForModel(object $model): void
    {
        $seo = $model->seo ?? null;
        if ($seo) {
            $this->seoService()->delete((int)$seo->id);
        }
    }

    protected function seoService(): SeoService
    {
        return Yii::$container->get(SeoService::class);
    }

    protected function slugService(): SlugService
    {
        return Yii::$container->get(SlugService::class);
    }
}
