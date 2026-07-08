<?php

namespace infrastructure\Product\Form;

use application\Product\Form\ProductFormModelProviderInterface;
use infrastructure\Product\ActiveRecord\ProductAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class ProductFormModelProvider extends ActiveRecordFormModelProvider implements ProductFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return ProductAR::class;
    }
}
