<?php

namespace infrastructure\Order\Repository;

use domain\Order\DataMapper\OrderDataMapperInterface;
use domain\Order\Entity\Order;
use domain\Order\Repository\OrderRepositoryInterface;
use infrastructure\Order\ActiveRecord\OrderAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class OrderRepository extends ActiveRecordCrudRepository implements OrderRepositoryInterface
{
    public function __construct(OrderDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return OrderAR::class;
    }

    protected function entityName(): string
    {
        return 'Order';
    }

    public function get(int $id): Order
    {
        return $this->getEntity($id);
    }

    public function save(Order $entity): Order
    {
        return $this->saveEntity($entity);
    }
}
