<?php

namespace domain\Page\Repository;

use domain\Page\Entity\Page;

interface PageRepositoryInterface
{
    public function get(int $id): Page;

    public function save(Page $entity): Page;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
