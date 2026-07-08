<?php

namespace backend\controllers;

use application\MeasurementType\Service\MeasurementTypeService;
use common\models\search\MeasurementTypeSearch;
use modules\admin\controllers\BaseCrudController;

class MeasurementTypeController extends BaseCrudController
{
    protected function serviceClass(): string
    {
        return MeasurementTypeService::class;
    }

    protected function searchModelClass(): string
    {
        return MeasurementTypeSearch::class;
    }
}
