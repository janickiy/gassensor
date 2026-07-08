<?php

namespace domain\Page\DataMapper;

use domain\Page\Entity\Page;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface PageDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Page;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
