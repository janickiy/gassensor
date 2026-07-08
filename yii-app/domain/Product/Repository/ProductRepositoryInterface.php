<?php

namespace domain\Product\Repository;

use domain\Product\Entity\Product;

interface ProductRepositoryInterface
{
    public function get(int $id): Product;

    public function save(Product $entity): Product;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
