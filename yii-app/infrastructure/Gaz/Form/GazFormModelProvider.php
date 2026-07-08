<?php

namespace infrastructure\Gaz\Form;

use application\Gaz\Form\GazFormModelProviderInterface;
use infrastructure\Gaz\ActiveRecord\GazAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class GazFormModelProvider extends ActiveRecordFormModelProvider implements GazFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return GazAR::class;
    }
}
