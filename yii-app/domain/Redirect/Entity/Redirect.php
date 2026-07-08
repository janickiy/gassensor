<?php

namespace domain\Redirect\Entity;

use domain\Shared\Entity\AbstractEntity;

class Redirect extends AbstractEntity
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

    public function getCreatedBy(): ?int
    {
        return $this->getInt('created_by');
    }

    public function setCreatedBy(?int $value): void
    {
        $this->setAttribute('created_by', $value);
    }

    public function getUpdatedBy(): ?int
    {
        return $this->getInt('updated_by');
    }

    public function setUpdatedBy(?int $value): void
    {
        $this->setAttribute('updated_by', $value);
    }

    public function getFrom(): ?string
    {
        return $this->getString('from');
    }

    public function setFrom(?string $value): void
    {
        $this->setAttribute('from', $value);
    }

    public function getTo(): ?string
    {
        return $this->getString('to');
    }

    public function setTo(?string $value): void
    {
        $this->setAttribute('to', $value);
    }

}
