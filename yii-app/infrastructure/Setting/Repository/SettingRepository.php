<?php

namespace infrastructure\Setting\Repository;

use domain\Setting\DataMapper\SettingDataMapperInterface;
use domain\Setting\Entity\Setting;
use domain\Setting\Repository\SettingRepositoryInterface;
use infrastructure\Setting\ActiveRecord\SettingAR;
use infrastructure\Shared\Repository\ActiveRecordCrudRepository;

class SettingRepository extends ActiveRecordCrudRepository implements SettingRepositoryInterface
{
    public function __construct(SettingDataMapperInterface $dataMapper)
    {
        parent::__construct($dataMapper);
    }

    protected function recordClass(): string
    {
        return SettingAR::class;
    }

    protected function entityName(): string
    {
        return 'Setting';
    }

    public function get(int $id): Setting
    {
        return $this->getEntity($id);
    }

    public function findByName(string $name): ?Setting
    {
        $record = SettingAR::findOne(['name' => $name]);

        return $record === null ? null : $this->dataMapper->toEntity($record);
    }

    public function save(Setting $entity): Setting
    {
        return $this->saveEntity($entity);
    }
}
