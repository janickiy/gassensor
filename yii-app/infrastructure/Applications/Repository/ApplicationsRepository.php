<?php

namespace infrastructure\Applications\Repository;

use domain\Applications\DataMapper\ApplicationsDataMapperInterface;
use domain\Applications\Entity\Applications;
use domain\Applications\Repository\ApplicationsRepositoryInterface;
use infrastructure\Applications\ActiveRecord\ApplicationsAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class ApplicationsRepository extends ActiveRecordCrudRepository implements ApplicationsRepositoryInterface
{
    public function __construct(ApplicationsDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return ApplicationsAR::class;
    }

    protected function entityName(): string
    {
        return 'Applications';
    }

    public function get(int $id): Applications
    {
        return $this->getEntity($id);
    }

    public function save(Applications $entity): Applications
    {
        return $this->saveEntity($entity);
    }
}
