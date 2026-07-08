<?php

namespace domain\Order\Repository;

use domain\Order\Entity\Order;

interface OrderRepositoryInterface
{
    public function get(int $id): Order;

    public function save(Order $entity): Order;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
