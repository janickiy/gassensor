<?php

namespace infrastructure\Manufacture\Form;

use application\Manufacture\Form\ManufactureFormModelProviderInterface;
use infrastructure\Manufacture\ActiveRecord\ManufactureAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class ManufactureFormModelProvider extends ActiveRecordFormModelProvider implements ManufactureFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return ManufactureAR::class;
    }
}
