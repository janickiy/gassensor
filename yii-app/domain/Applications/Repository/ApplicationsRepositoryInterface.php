<?php

namespace domain\Applications\Repository;

use domain\Applications\Entity\Applications;

interface ApplicationsRepositoryInterface
{
    public function get(int $id): Applications;

    public function save(Applications $entity): Applications;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
