<?php

namespace infrastructure\OrderProduct\Repository;

use domain\OrderProduct\Entity\OrderProduct;
use domain\OrderProduct\Repository\OrderProductRepositoryInterface;
use domain\Shared\Exception\EntityNotFoundException;
use domain\Shared\Exception\EntitySaveException;
use infrastructure\OrderProduct\ActiveRecord\OrderProductAR;
use domain\OrderProduct\DataMapper\OrderProductDataMapperInterface;

class OrderProductRepository implements OrderProductRepositoryInterface
{
    private OrderProductDataMapperInterface $dataMapper;

    public function __construct(OrderProductDataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    public function getByPrimaryKey(int $orderId, ?int $productId): OrderProduct
    {
        $record = OrderProductAR::findOne(['order_id' => $orderId, 'product_id' => $productId]);
        if ($record === null) {
            throw EntityNotFoundException::forId('OrderProduct', $orderId);
        }

        return $this->dataMapper->toEntity($record);
    }

    public function save(OrderProduct $entity): OrderProduct
    {
        $orderId = $entity->getOrderId();
        $productId = $entity->getProductId();
        $record = $orderId === null ? null : OrderProductAR::findOne(['order_id' => $orderId, 'product_id' => $productId]);
        $record = $record ?: new OrderProductAR();
        $this->dataMapper->fillRecord($record, $entity);

        if (!$record->save(false)) {
            throw EntitySaveException::forEntity('OrderProduct');
        }

        return $this->dataMapper->toEntity($record);
    }

    public function deleteByPrimaryKey(int $orderId, ?int $productId): void
    {
        OrderProductAR::deleteAll(['order_id' => $orderId, 'product_id' => $productId]);
    }
}
