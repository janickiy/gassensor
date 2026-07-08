<?php

namespace domain\News\Entity;

use domain\Shared\Entity\AbstractEntity;

class News extends AbstractEntity
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

    public function getDate(): ?string
    {
        return $this->getString('date');
    }

    public function setDate(?string $value): void
    {
        $this->setAttribute('date', $value);
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

}
