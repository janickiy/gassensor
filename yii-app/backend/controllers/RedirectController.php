<?php

namespace backend\controllers;

use application\Redirect\Service\RedirectService;
use common\models\search\RedirectSearch;
use modules\admin\controllers\BaseCrudController;

class RedirectController extends BaseCrudController
{
    protected function serviceClass(): string
    {
        return RedirectService::class;
    }

    protected function searchModelClass(): string
    {
        return RedirectSearch::class;
    }
}
