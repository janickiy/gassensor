<?php

namespace backend\controllers;

use application\Gaz\Service\GazService;
use common\models\search\GazSearch;
use common\models\Seo;
use modules\admin\controllers\SeoCrudController;

class GazController extends SeoCrudController
{
    protected function serviceClass(): string
    {
        return GazService::class;
    }

    protected function searchModelClass(): string
    {
        return GazSearch::class;
    }

    protected function seoType(): int
    {
        return Seo::TYPE_CATALOG_GAZ;
    }

    protected function slugSource(object $model): string
    {
        return (string)($model->slug ?: $model->title);
    }
}
