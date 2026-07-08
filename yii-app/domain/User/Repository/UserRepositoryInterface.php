<?php

namespace domain\User\Repository;

use domain\User\Entity\User;

interface UserRepositoryInterface
{
    public function get(int $id): User;

    public function save(User $entity): User;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
