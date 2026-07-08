<?php

namespace infrastructure\Redirect\Repository;

use domain\Redirect\DataMapper\RedirectDataMapperInterface;
use domain\Redirect\Entity\Redirect;
use domain\Redirect\Repository\RedirectRepositoryInterface;
use infrastructure\Redirect\ActiveRecord\RedirectAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class RedirectRepository extends ActiveRecordCrudRepository implements RedirectRepositoryInterface
{
    public function __construct(RedirectDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return RedirectAR::class;
    }

    protected function entityName(): string
    {
        return 'Redirect';
    }

    public function get(int $id): Redirect
    {
        return $this->getEntity($id);
    }

    public function save(Redirect $entity): Redirect
    {
        return $this->saveEntity($entity);
    }
}
