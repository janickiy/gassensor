<?php

namespace infrastructure\OrderProduct\Form;

use application\OrderProduct\Form\OrderProductFormModelProviderInterface;
use infrastructure\OrderProduct\ActiveRecord\OrderProductAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class OrderProductFormModelProvider extends ActiveRecordFormModelProvider implements OrderProductFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return OrderProductAR::class;
    }
}
