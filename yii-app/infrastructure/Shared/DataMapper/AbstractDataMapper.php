<?php

namespace infrastructure\Shared\DataMapper;

use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;
use InvalidArgumentException;

abstract class AbstractDataMapper implements DataMapperInterface
{
    /** @var string[] */
    private array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    abstract protected function entityClass(): string;

    public function toEntity(object $record): AbstractEntity
    {
        if (!method_exists($record, 'getAttributes')) {
            throw new InvalidArgumentException('Record must provide getAttributes().');
        }

        $class = $this->entityClass();

        return new $class($record->getAttributes($this->attributes));
    }

    public function fillRecord(object $record, AbstractEntity $entity): object
    {
        if (!method_exists($record, 'setAttributes')) {
            throw new InvalidArgumentException('Record must provide setAttributes().');
        }

        $data = array_intersect_key($entity->toArray(), array_flip($this->attributes));
        $record->setAttributes($data, false);

        return $record;
    }
}
