<?php

namespace domain\News\DataMapper;

use domain\News\Entity\News;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface NewsDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): News;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
