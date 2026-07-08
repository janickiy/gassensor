<?php

namespace infrastructure\Seo\Form;

use application\Seo\Form\SeoFormModelProviderInterface;
use infrastructure\Seo\ActiveRecord\SeoAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class SeoFormModelProvider extends ActiveRecordFormModelProvider implements SeoFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return SeoAR::class;
    }
}
