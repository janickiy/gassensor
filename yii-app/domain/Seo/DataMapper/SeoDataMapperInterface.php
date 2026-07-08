<?php

namespace domain\Seo\DataMapper;

use domain\Seo\Entity\Seo;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface SeoDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Seo;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
