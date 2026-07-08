<?php

namespace domain\User\DataMapper;

use domain\User\Entity\User;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface UserDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): User;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
