<?php

namespace domain\Url\DataMapper;

use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;
use domain\Url\Entity\Url;

interface UrlDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Url;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
