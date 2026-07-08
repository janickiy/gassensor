<?php

namespace domain\News\Repository;

use domain\News\Entity\News;

interface NewsRepositoryInterface
{
    public function get(int $id): News;

    public function save(News $entity): News;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
