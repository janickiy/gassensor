<?php

namespace backend\controllers;

use application\Url\Service\UrlService;
use common\models\search\UrlSearch;
use modules\admin\controllers\BaseCrudController;

class UrlController extends BaseCrudController
{
    protected function serviceClass(): string
    {
        return UrlService::class;
    }

    protected function searchModelClass(): string
    {
        return UrlSearch::class;
    }
}
