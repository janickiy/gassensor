<?php

namespace infrastructure\Redirect\DataMapper;

use domain\Redirect\DataMapper\RedirectDataMapperInterface;
use domain\Redirect\Entity\Redirect;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class RedirectDataMapper extends AbstractDataMapper implements RedirectDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'from', 'to']);
    }

    public function toEntity(object $record): Redirect
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Redirect::class;
    }
}
