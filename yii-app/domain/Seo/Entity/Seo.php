<?php

namespace domain\Seo\Entity;

use domain\Shared\Entity\AbstractEntity;

class Seo extends AbstractEntity
{
    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function setId(?int $value): void
    {
        $this->setAttribute('id', $value);
    }

    public function getRefId(): ?int
    {
        return $this->getInt('ref_id');
    }

    public function setRefId(?int $value): void
    {
        $this->setAttribute('ref_id', $value);
    }

    public function getType(): ?int
    {
        return $this->getInt('type');
    }

    public function setType(?int $value): void
    {
        $this->setAttribute('type', $value);
    }

    public function getH1(): ?string
    {
        return $this->getString('h1');
    }

    public function setH1(?string $value): void
    {
        $this->setAttribute('h1', $value);
    }

    public function getTitle(): ?string
    {
        return $this->getString('title');
    }

    public function setTitle(?string $value): void
    {
        $this->setAttribute('title', $value);
    }

    public function getKeyword(): ?string
    {
        return $this->getString('keyword');
    }

    public function setKeyword(?string $value): void
    {
        $this->setAttribute('keyword', $value);
    }

    public function getDescription(): ?string
    {
        return $this->getString('description');
    }

    public function setDescription(?string $value): void
    {
        $this->setAttribute('description', $value);
    }

    public function getUrlCanonical(): ?string
    {
        return $this->getString('url_canonical');
    }

    public function setUrlCanonical(?string $value): void
    {
        $this->setAttribute('url_canonical', $value);
    }

}
