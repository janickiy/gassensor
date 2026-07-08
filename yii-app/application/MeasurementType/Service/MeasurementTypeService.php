<?php

namespace application\MeasurementType\Service;

use application\MeasurementType\Form\MeasurementTypeFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\MeasurementType\DataMapper\MeasurementTypeDataMapperInterface;
use domain\MeasurementType\Repository\MeasurementTypeRepositoryInterface;

class MeasurementTypeService extends CrudService
{
    public function __construct(
        MeasurementTypeRepositoryInterface $repository,
        MeasurementTypeDataMapperInterface $dataMapper,
        MeasurementTypeFormModelProviderInterface $formModelProvider
    ) {
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }
}
