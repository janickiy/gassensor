<?php

namespace domain\Order\DataMapper;

use domain\Order\Entity\Order;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface OrderDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Order;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
