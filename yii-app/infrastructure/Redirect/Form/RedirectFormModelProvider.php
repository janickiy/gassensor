<?php

namespace infrastructure\Redirect\Form;

use application\Redirect\Form\RedirectFormModelProviderInterface;
use infrastructure\Redirect\ActiveRecord\RedirectAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class RedirectFormModelProvider extends ActiveRecordFormModelProvider implements RedirectFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return RedirectAR::class;
    }
}
