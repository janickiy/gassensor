<?php

namespace infrastructure\MeasurementType\DataMapper;

use domain\MeasurementType\DataMapper\MeasurementTypeDataMapperInterface;
use domain\MeasurementType\Entity\MeasurementType;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class MeasurementTypeDataMapper extends AbstractDataMapper implements MeasurementTypeDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'name']);
    }

    public function toEntity(object $record): MeasurementType
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return MeasurementType::class;
    }
}
