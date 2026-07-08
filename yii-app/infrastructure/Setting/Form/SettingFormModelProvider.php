<?php

namespace infrastructure\Setting\Form;

use application\Setting\Form\SettingFormModelProviderInterface;
use infrastructure\Setting\ActiveRecord\SettingAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class SettingFormModelProvider extends ActiveRecordFormModelProvider implements SettingFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return SettingAR::class;
    }
}
