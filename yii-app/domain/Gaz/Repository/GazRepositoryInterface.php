<?php

namespace domain\Gaz\Repository;

use domain\Gaz\Entity\Gaz;

interface GazRepositoryInterface
{
    public function get(int $id): Gaz;

    public function save(Gaz $entity): Gaz;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
