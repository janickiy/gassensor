<?php

namespace infrastructure\MeasurementType\Repository;

use domain\MeasurementType\DataMapper\MeasurementTypeDataMapperInterface;
use domain\MeasurementType\Entity\MeasurementType;
use domain\MeasurementType\Repository\MeasurementTypeRepositoryInterface;
use infrastructure\MeasurementType\ActiveRecord\MeasurementTypeAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class MeasurementTypeRepository extends ActiveRecordCrudRepository implements MeasurementTypeRepositoryInterface
{
    public function __construct(MeasurementTypeDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return MeasurementTypeAR::class;
    }

    protected function entityName(): string
    {
        return 'MeasurementType';
    }

    public function get(int $id): MeasurementType
    {
        return $this->getEntity($id);
    }

    public function save(MeasurementType $entity): MeasurementType
    {
        return $this->saveEntity($entity);
    }
}
