<?php

namespace domain\Url\Repository;

use domain\Url\Entity\Url;

interface UrlRepositoryInterface
{
    public function get(int $id): Url;

    public function save(Url $entity): Url;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
