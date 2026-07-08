<?php

namespace domain\Gaz\DataMapper;

use domain\Gaz\Entity\Gaz;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface GazDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Gaz;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
