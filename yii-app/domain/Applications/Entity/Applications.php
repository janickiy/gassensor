<?php

namespace domain\Applications\Entity;

use domain\Shared\Entity\AbstractEntity;

class Applications extends AbstractEntity
{
    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function setId(?int $value): void
    {
        $this->setAttribute('id', $value);
    }

    public function getSlug(): ?string
    {
        return $this->getString('slug');
    }

    public function setSlug(?string $value): void
    {
        $this->setAttribute('slug', $value);
    }

    public function getTitle(): ?string
    {
        return $this->getString('title');
    }

    public function setTitle(?string $value): void
    {
        $this->setAttribute('title', $value);
    }

    public function getContent(): ?string
    {
        return $this->getString('content');
    }

    public function setContent(?string $value): void
    {
        $this->setAttribute('content', $value);
    }

    public function getType(): ?int
    {
        return $this->getInt('type');
    }

    public function setType(?int $value): void
    {
        $this->setAttribute('type', $value);
    }

}
