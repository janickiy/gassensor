<?php

namespace infrastructure\News\Form;

use application\News\Form\NewsFormModelProviderInterface;
use infrastructure\News\ActiveRecord\NewsAR;
use infrastructure\Shared\Form\ActiveRecordFormModelProvider;

class NewsFormModelProvider extends ActiveRecordFormModelProvider implements NewsFormModelProviderInterface
{
    protected function recordClass(): string
    {
        return NewsAR::class;
    }
}
