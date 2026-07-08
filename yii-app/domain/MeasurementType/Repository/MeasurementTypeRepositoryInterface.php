<?php

namespace domain\MeasurementType\Repository;

use domain\MeasurementType\Entity\MeasurementType;

interface MeasurementTypeRepositoryInterface
{
    public function get(int $id): MeasurementType;

    public function save(MeasurementType $entity): MeasurementType;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
