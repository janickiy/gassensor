<?php

namespace domain\Product\DataMapper;

use domain\Product\Entity\Product;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface ProductDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Product;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
