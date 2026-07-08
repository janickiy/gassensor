<?php

namespace infrastructure\Applications\Form;

use application\Applications\Form\ApplicationsFormModelProviderInterface;
use infrastructure\Applications\ActiveRecord\ApplicationsAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class ApplicationsFormModelProvider extends ActiveRecordFormModelProvider implements ApplicationsFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return ApplicationsAR::class;
    }
}
