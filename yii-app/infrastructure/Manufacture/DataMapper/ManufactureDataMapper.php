<?php

namespace infrastructure\Manufacture\DataMapper;

use domain\Manufacture\DataMapper\ManufactureDataMapperInterface;
use domain\Manufacture\Entity\Manufacture;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class ManufactureDataMapper extends AbstractDataMapper implements ManufactureDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'created_at', 'slug', 'weight', 'title', 'logo', 'url', 'country', 'short_description', 'description']);
    }

    public function toEntity(object $record): Manufacture
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Manufacture::class;
    }
}
