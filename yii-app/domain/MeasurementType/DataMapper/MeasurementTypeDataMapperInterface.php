<?php

namespace domain\MeasurementType\DataMapper;

use domain\MeasurementType\Entity\MeasurementType;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface MeasurementTypeDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): MeasurementType;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
