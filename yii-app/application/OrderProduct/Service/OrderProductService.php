<?php

namespace application\OrderProduct\Service;

use application\Shared\DTO\CrudResultDto;
use domain\OrderProduct\Entity\OrderProduct;
use domain\OrderProduct\Repository\OrderProductRepositoryInterface;

class OrderProductService
{
    private OrderProductRepositoryInterface $repository;

    public function __construct(OrderProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function save(OrderProduct $entity): CrudResultDto
    {
        return CrudResultDto::fromEntity($this->repository->save($entity));
    }
}
