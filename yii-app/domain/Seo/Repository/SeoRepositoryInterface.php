<?php

namespace domain\Seo\Repository;

use domain\Seo\Entity\Seo;

interface SeoRepositoryInterface
{
    public function get(int $id): Seo;

    public function save(Seo $entity): Seo;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
