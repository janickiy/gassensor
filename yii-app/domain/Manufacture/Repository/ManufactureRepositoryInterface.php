<?php

namespace domain\Manufacture\Repository;

use domain\Manufacture\Entity\Manufacture;

interface ManufactureRepositoryInterface
{
    public function get(int $id): Manufacture;

    public function save(Manufacture $entity): Manufacture;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
