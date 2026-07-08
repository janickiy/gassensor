<?php

namespace domain\Page\Entity;

use domain\Shared\Entity\AbstractEntity;

class Page extends AbstractEntity
{
    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function setId(?int $value): void
    {
        $this->setAttribute('id', $value);
    }

    public function getType(): ?int
    {
        return $this->getInt('type');
    }

    public function setType(?int $value): void
    {
        $this->setAttribute('type', $value);
    }

    public function getRefId(): ?int
    {
        return $this->getInt('ref_id');
    }

    public function setRefId(?int $value): void
    {
        $this->setAttribute('ref_id', $value);
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
