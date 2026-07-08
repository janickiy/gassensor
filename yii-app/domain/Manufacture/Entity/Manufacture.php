<?php

namespace domain\Manufacture\Entity;

use domain\Shared\Entity\AbstractEntity;

class Manufacture extends AbstractEntity
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

    public function getSlug(): ?string
    {
        return $this->getString('slug');
    }

    public function setSlug(?string $value): void
    {
        $this->setAttribute('slug', $value);
    }

    public function getWeight(): ?int
    {
        return $this->getInt('weight');
    }

    public function setWeight(?int $value): void
    {
        $this->setAttribute('weight', $value);
    }

    public function getTitle(): ?string
    {
        return $this->getString('title');
    }

    public function setTitle(?string $value): void
    {
        $this->setAttribute('title', $value);
    }

    public function getLogo(): ?string
    {
        return $this->getString('logo');
    }

    public function setLogo(?string $value): void
    {
        $this->setAttribute('logo', $value);
    }

    public function getUrl(): ?string
    {
        return $this->getString('url');
    }

    public function setUrl(?string $value): void
    {
        $this->setAttribute('url', $value);
    }

    public function getCountry(): ?string
    {
        return $this->getString('country');
    }

    public function setCountry(?string $value): void
    {
        $this->setAttribute('country', $value);
    }

    public function getShortDescription(): ?string
    {
        return $this->getString('short_description');
    }

    public function setShortDescription(?string $value): void
    {
        $this->setAttribute('short_description', $value);
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
