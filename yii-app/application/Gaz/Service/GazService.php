<?php

namespace application\Gaz\Service;

use application\Gaz\Form\GazFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\Gaz\DataMapper\GazDataMapperInterface;
use domain\Gaz\Repository\GazRepositoryInterface;

class GazService extends CrudService
{
    public function __construct(
        GazRepositoryInterface $repository,
        GazDataMapperInterface $dataMapper,
        GazFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
