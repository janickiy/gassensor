<?php

namespace infrastructure\Order\DataMapper;

use domain\Order\DataMapper\OrderDataMapperInterface;
use domain\Order\Entity\Order;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class OrderDataMapper extends AbstractDataMapper implements OrderDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'created_at', 'status', 'name', 'email', 'phone', 'delivery_info', 'comment']);
    }

    public function toEntity(object $record): Order
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Order::class;
    }
}
