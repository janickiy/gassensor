<?php

namespace application\Product\Service;

use application\Product\Form\ProductFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\Product\DataMapper\ProductDataMapperInterface;
use domain\Product\Repository\ProductRepositoryInterface;

class ProductService extends CrudService
{
    public function __construct(
        ProductRepositoryInterface $repository,
        ProductDataMapperInterface $dataMapper,
        ProductFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
