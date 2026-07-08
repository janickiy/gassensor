<?php

namespace infrastructure\Product\Repository;

use domain\Product\DataMapper\ProductDataMapperInterface;
use domain\Product\Entity\Product;
use domain\Product\Repository\ProductRepositoryInterface;
use infrastructure\Product\ActiveRecord\ProductAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class ProductRepository extends ActiveRecordCrudRepository implements ProductRepositoryInterface
{
    public function __construct(ProductDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return ProductAR::class;
    }

    protected function entityName(): string
    {
        return 'Product';
    }

    public function get(int $id): Product
    {
        return $this->getEntity($id);
    }

    public function save(Product $entity): Product
    {
        return $this->saveEntity($entity);
    }
}
