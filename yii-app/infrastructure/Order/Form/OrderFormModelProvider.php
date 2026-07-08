<?php

namespace infrastructure\Order\Form;

use application\Order\Form\OrderFormModelProviderInterface;
use infrastructure\Order\ActiveRecord\OrderAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class OrderFormModelProvider extends ActiveRecordFormModelProvider implements OrderFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return OrderAR::class;
    }
}
