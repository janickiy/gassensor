<?php

namespace domain\Shared\Entity;

use domain\Shared\Exception\DomainException;

abstract class AbstractEntity
{
    /** @var array<string, mixed> */
    protected array $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->changeAttributes($attributes);
    }

    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function setId(?int $id): void
    {
        $this->setAttribute('id', $id);
    }

    public function hasAttribute(string $name): bool
    {
        return array_key_exists($name, $this->attributes);
    }

    public function getAttribute(string $name, $default = null)
    {
        return $this->attributes[$name] ?? $default;
    }

    public function setAttribute(string $name, $value): void
    {
        $this->attributes[$name] = $value;
    }

    public function changeAttributes(array $attributes): void
    {
        foreach ($attributes as $name => $value) {
            $this->setAttribute((string)$name, $value);
        }
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    protected function getInt(string $name): ?int
    {
        $value = $this->getAttribute($name);
        return $value === null || $value === '' ? null : (int)$value;
    }

    protected function getFloat(string $name): ?float
    {
        $value = $this->getAttribute($name);
        return $value === null || $value === '' ? null : (float)$value;
    }

    protected function getString(string $name): ?string
    {
        $value = $this->getAttribute($name);
        return $value === null ? null : (string)$value;
    }

    protected function requireFilled(array $names): void
    {
        foreach ($names as $name) {
            $value = $this->getAttribute((string)$name);
            if ($value === null || $value === '') {
                throw new DomainException("Attribute {$name} is required.");
            }
        }
    }
}
