<?php

namespace infrastructure\User\Form;

use application\User\Form\UserFormModelProviderInterface;
use infrastructure\User\ActiveRecord\UserAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class UserFormModelProvider extends ActiveRecordFormModelProvider implements UserFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return UserAR::class;
    }
}
