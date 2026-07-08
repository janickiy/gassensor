<?php

namespace infrastructure\MeasurementType\Form;

use application\MeasurementType\Form\MeasurementTypeFormModelProviderInterface;
use infrastructure\MeasurementType\ActiveRecord\MeasurementTypeAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class MeasurementTypeFormModelProvider extends ActiveRecordFormModelProvider implements MeasurementTypeFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return MeasurementTypeAR::class;
    }
}
