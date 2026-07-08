<?php

namespace domain\OrderProduct\Repository;

use domain\OrderProduct\Entity\OrderProduct;

interface OrderProductRepositoryInterface
{
    public function getByPrimaryKey(int $orderId, ?int $productId): OrderProduct;

    public function save(OrderProduct $entity): OrderProduct;

    public function deleteByPrimaryKey(int $orderId, ?int $productId): void;
}
