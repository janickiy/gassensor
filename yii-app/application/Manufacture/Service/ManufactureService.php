<?php

namespace application\Manufacture\Service;

use application\Manufacture\Form\ManufactureFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\Manufacture\DataMapper\ManufactureDataMapperInterface;
use domain\Manufacture\Repository\ManufactureRepositoryInterface;

class ManufactureService extends CrudService
{
    public function __construct(
        ManufactureRepositoryInterface $repository,
        ManufactureDataMapperInterface $dataMapper,
        ManufactureFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
