<?php

namespace infrastructure\Manufacture\Repository;

use domain\Manufacture\DataMapper\ManufactureDataMapperInterface;
use domain\Manufacture\Entity\Manufacture;
use domain\Manufacture\Repository\ManufactureRepositoryInterface;
use infrastructure\Manufacture\ActiveRecord\ManufactureAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class ManufactureRepository extends ActiveRecordCrudRepository implements ManufactureRepositoryInterface
{
    public function __construct(ManufactureDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return ManufactureAR::class;
    }

    protected function entityName(): string
    {
        return 'Manufacture';
    }

    public function get(int $id): Manufacture
    {
        return $this->getEntity($id);
    }

    public function save(Manufacture $entity): Manufacture
    {
        return $this->saveEntity($entity);
    }
}
