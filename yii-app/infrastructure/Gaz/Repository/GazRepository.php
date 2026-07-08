<?php

namespace infrastructure\Gaz\Repository;

use domain\Gaz\DataMapper\GazDataMapperInterface;
use domain\Gaz\Entity\Gaz;
use domain\Gaz\Repository\GazRepositoryInterface;
use infrastructure\Gaz\ActiveRecord\GazAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class GazRepository extends ActiveRecordCrudRepository implements GazRepositoryInterface
{
    public function __construct(GazDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return GazAR::class;
    }

    protected function entityName(): string
    {
        return 'Gaz';
    }

    public function get(int $id): Gaz
    {
        return $this->getEntity($id);
    }

    public function save(Gaz $entity): Gaz
    {
        return $this->saveEntity($entity);
    }
}
