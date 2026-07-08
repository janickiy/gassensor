<?php

namespace infrastructure\Page\Form;

use application\Page\Form\PageFormModelProviderInterface;
use infrastructure\Page\ActiveRecord\PageAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class PageFormModelProvider extends ActiveRecordFormModelProvider implements PageFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return PageAR::class;
    }
}
