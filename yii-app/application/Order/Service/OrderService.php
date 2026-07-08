<?php

namespace application\Order\Service;

use application\Order\Form\OrderFormModelProviderInterface;
use application\Shared\DTO\CrudResultDto;
use application\Shared\Service\CrudService;
use domain\Order\DataMapper\OrderDataMapperInterface;
use domain\Order\Repository\OrderRepositoryInterface;

class OrderService extends CrudService
{
    private OrderRepositoryInterface $orderRepository;

    public function __construct(
        OrderRepositoryInterface $repository,
        OrderDataMapperInterface $dataMapper,
        OrderFormModelProviderInterface $formModelProvider
    ) {
        $this->orderRepository = $repository;
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }

    public function setStatus(int $id, int $status): CrudResultDto
    {
        $order = $this->orderRepository->get($id);
        $order->setStatus($status);

        return CrudResultDto::fromEntity($this->orderRepository->save($order));
    }
}
