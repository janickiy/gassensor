<?php

namespace backend\controllers;

use application\Applications\Service\ApplicationsService;
use common\models\search\ApplicationsSearch;
use common\models\Seo;
use modules\admin\controllers\SeoCrudController;

class ApplicationsController extends SeoCrudController
{
    protected function serviceClass(): string
    {
        return ApplicationsService::class;
    }

    protected function searchModelClass(): string
    {
        return ApplicationsSearch::class;
    }

    protected function seoType(): int
    {
        return Seo::TYPE_APPLICATIONS;
    }
}
