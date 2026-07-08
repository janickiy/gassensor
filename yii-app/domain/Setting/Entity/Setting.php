<?php

namespace domain\Setting\Entity;

use domain\Shared\Entity\AbstractEntity;

class Setting extends AbstractEntity
{
    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function setId(?int $value): void
    {
        $this->setAttribute('id', $value);
    }

    public function getCreatedAt(): ?int
    {
        return $this->getInt('created_at');
    }

    public function setCreatedAt(?int $value): void
    {
        $this->setAttribute('created_at', $value);
    }

    public function getUpdatedAt(): ?int
    {
        return $this->getInt('updated_at');
    }

    public function setUpdatedAt(?int $value): void
    {
        $this->setAttribute('updated_at', $value);
    }

    public function getName(): ?string
    {
        return $this->getString('name');
    }

    public function setName(?string $value): void
    {
        $this->setAttribute('name', $value);
    }

    public function getValue(): ?string
    {
        return $this->getString('value');
    }

    public function setValue(?string $value): void
    {
        $this->setAttribute('value', $value);
    }

    public function getDescription(): ?string
    {
        return $this->getString('description');
    }

    public function setDescription(?string $value): void
    {
        $this->setAttribute('description', $value);
    }

}
