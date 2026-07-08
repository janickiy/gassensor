<?php

namespace infrastructure\User\Repository;

use domain\User\DataMapper\UserDataMapperInterface;
use domain\User\Entity\User;
use domain\User\Repository\UserRepositoryInterface;
use infrastructure\User\ActiveRecord\UserAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class UserRepository extends ActiveRecordCrudRepository implements UserRepositoryInterface
{
    public function __construct(UserDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return UserAR::class;
    }

    protected function entityName(): string
    {
        return 'User';
    }

    public function get(int $id): User
    {
        return $this->getEntity($id);
    }

    public function save(User $entity): User
    {
        return $this->saveEntity($entity);
    }
}
