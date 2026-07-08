<?php

namespace domain\Shared\DataMapper;

use domain\Shared\Entity\AbstractEntity;

interface DataMapperInterface
{
    public function toEntity(object $record): AbstractEntity;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
