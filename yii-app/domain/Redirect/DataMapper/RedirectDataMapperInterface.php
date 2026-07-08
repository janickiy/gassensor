<?php

namespace domain\Redirect\DataMapper;

use domain\Redirect\Entity\Redirect;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface RedirectDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Redirect;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
