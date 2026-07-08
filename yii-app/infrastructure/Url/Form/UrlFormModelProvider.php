<?php

namespace infrastructure\Url\Form;

use application\Url\Form\UrlFormModelProviderInterface;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;
use infrastructure\Url\ActiveRecord\UrlAR;

class UrlFormModelProvider extends ActiveRecordFormModelProvider implements UrlFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return UrlAR::class;
    }
}
