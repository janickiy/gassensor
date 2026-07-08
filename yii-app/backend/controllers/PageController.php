<?php

namespace backend\controllers;

use application\Page\Service\PageService;
use common\models\search\PageSearch;
use modules\admin\controllers\BaseCrudController;

class PageController extends BaseCrudController
{
    protected function serviceClass(): string
    {
        return PageService::class;
    }

    protected function searchModelClass(): string
    {
        return PageSearch::class;
    }
}
