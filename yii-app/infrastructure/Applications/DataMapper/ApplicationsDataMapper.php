<?php

namespace infrastructure\Applications\DataMapper;

use domain\Applications\DataMapper\ApplicationsDataMapperInterface;
use domain\Applications\Entity\Applications;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class ApplicationsDataMapper extends AbstractDataMapper implements ApplicationsDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'slug', 'title', 'content', 'type']);
    }

    public function toEntity(object $record): Applications
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Applications::class;
    }
}
