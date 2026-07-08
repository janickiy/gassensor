<?php

namespace domain\Redirect\Repository;

use domain\Redirect\Entity\Redirect;

interface RedirectRepositoryInterface
{
    public function get(int $id): Redirect;

    public function save(Redirect $entity): Redirect;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
