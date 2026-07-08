<?php

namespace application\Shared\Service;

use application\Shared\DTO\CrudResultDto;
use application\Shared\Form\FormModelProviderInterface;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

abstract class CrudService
{
    protected object $repository;
    protected DataMapperInterface $dataMapper;
    protected FormModelProviderInterface $formModelProvider;

    public function __construct(
        object $repository,
        DataMapperInterface $dataMapper,
        FormModelProviderInterface $formModelProvider
    ) {
        $this->repository = $repository;
        $this->dataMapper = $dataMapper;
        $this->formModelProvider = $formModelProvider;
    }

    public function createModel(array $config = []): object
    {
        $model = $this->formModelProvider->create($config);
        $this->formModelProvider->loadDefaultValues($model);

        return $model;
    }

    public function getModel(int $id): object
    {
        return $this->formModelProvider->find($id);
    }

    public function getEntity(int $id): AbstractEntity
    {
        return $this->repository->get($id);
    }

    public function load(object $model, array $data, ?string $formName = null): bool
    {
        return $this->formModelProvider->load($model, $data, $formName);
    }

    public function validate(object $model, ?array $attributeNames = null): bool
    {
        return $this->formModelProvider->validate($model, $attributeNames);
    }

    public function saveModel(object $model): CrudResultDto
    {
        $entity = $this->dataMapper->toEntity($model);
        $savedEntity = $this->repository->save($entity);
        if (method_exists($model, 'setAttributes')) {
            $model->setAttributes($savedEntity->toArray(), false);
        }

        return CrudResultDto::fromEntity($savedEntity);
    }

    public function saveEntity(AbstractEntity $entity): CrudResultDto
    {
        $savedEntity = $this->repository->save($entity);

        return CrudResultDto::fromEntity($savedEntity);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    public function deleteMany(array $ids): int
    {
        return $this->repository->deleteMany($ids);
    }
}
