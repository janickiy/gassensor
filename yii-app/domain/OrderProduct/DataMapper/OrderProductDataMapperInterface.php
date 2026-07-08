<?php

namespace domain\OrderProduct\DataMapper;

use domain\OrderProduct\Entity\OrderProduct;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface OrderProductDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): OrderProduct;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
