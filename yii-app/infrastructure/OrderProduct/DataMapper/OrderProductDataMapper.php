<?php

namespace infrastructure\OrderProduct\DataMapper;

use domain\OrderProduct\DataMapper\OrderProductDataMapperInterface;
use domain\OrderProduct\Entity\OrderProduct;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class OrderProductDataMapper extends AbstractDataMapper implements OrderProductDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['order_id', 'product_id', 'product_info', 'count', 'price']);
    }

    public function toEntity(object $record): OrderProduct
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return OrderProduct::class;
    }
}
