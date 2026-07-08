<?php

namespace domain\Applications\DataMapper;

use domain\Applications\Entity\Applications;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface ApplicationsDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Applications;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
