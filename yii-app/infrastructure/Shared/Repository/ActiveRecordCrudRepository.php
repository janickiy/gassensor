<?php

namespace infrastructure\Shared\Repository;

use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;
use domain\Shared\Exception\EntityNotFoundException;
use domain\Shared\Exception\EntitySaveException;
use yii\db\ActiveRecord;

abstract class ActiveRecordCrudRepository
{
    protected DataMapperInterface $dataMapper;

    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    abstract protected function recordClass(): string;

    abstract protected function entityName(): string;

    protected function getRecord(int $id): ActiveRecord
    {
        $class = $this->recordClass();
        $record = $class::findOne($id);
        if ($record === null) {
            throw EntityNotFoundException::forId($this->entityName(), $id);
        }

        return $record;
    }

    protected function getEntity(int $id): AbstractEntity
    {
        return $this->dataMapper->toEntity($this->getRecord($id));
    }

    protected function saveEntity(AbstractEntity $entity): AbstractEntity
    {
        $class = $this->recordClass();
        $id = $entity->getId();
        $record = $id === null ? new $class() : $this->getRecord($id);
        $this->dataMapper->fillRecord($record, $entity);

        if (!$record->save(false)) {
            throw EntitySaveException::forEntity($this->entityName());
        }

        return $this->dataMapper->toEntity($record);
    }

    public function delete(int $id): void
    {
        $this->getRecord($id)->delete();
    }

    public function deleteMany(array $ids): int
    {
        $ids = array_values(array_filter(array_map('intval', $ids)));
        if ($ids === []) {
            return 0;
        }

        $class = $this->recordClass();

        return (int)$class::deleteAll(['id' => $ids]);
    }
}
