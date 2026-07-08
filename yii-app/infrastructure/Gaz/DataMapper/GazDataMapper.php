<?php

namespace infrastructure\Gaz\DataMapper;

use domain\Gaz\DataMapper\GazDataMapperInterface;
use domain\Gaz\Entity\Gaz;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class GazDataMapper extends AbstractDataMapper implements GazDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'title', 'weight', 'chemical_formula', 'chemical_formula_html', 'slug', 'description']);
    }

    public function toEntity(object $record): Gaz
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Gaz::class;
    }
}
