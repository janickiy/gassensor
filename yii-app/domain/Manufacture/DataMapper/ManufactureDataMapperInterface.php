<?php

namespace domain\Manufacture\DataMapper;

use domain\Manufacture\Entity\Manufacture;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface ManufactureDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Manufacture;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
