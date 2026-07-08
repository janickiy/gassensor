<?php

namespace application\Applications\Service;

use application\Applications\Form\ApplicationsFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\Applications\DataMapper\ApplicationsDataMapperInterface;
use domain\Applications\Repository\ApplicationsRepositoryInterface;

class ApplicationsService extends CrudService
{
    public function __construct(
        ApplicationsRepositoryInterface $repository,
        ApplicationsDataMapperInterface $dataMapper,
        ApplicationsFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
