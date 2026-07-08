<?php

namespace application\Shared\DTO;

use domain\Shared\Entity\AbstractEntity;

class CrudResultDto
{
    private ?int $id;

    /** @var array<string, mixed> */
    private array $attributes;

    public function __construct(?int $id, array $attributes = [])
    {
        $this->id = $id;
        $this->attributes = $attributes;
    }

    public static function fromEntity(AbstractEntity $entity): self
    {
        return new self($entity->getId(), $entity->toArray());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
