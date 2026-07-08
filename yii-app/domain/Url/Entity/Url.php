<?php

namespace domain\Url\Entity;

use domain\Shared\Entity\AbstractEntity;

class Url extends AbstractEntity
{
    public function getUrl(): ?string
    {
        return $this->getString('url');
    }

    public function setUrl(?string $url): void
    {
        $this->setAttribute('url', $url);
    }

    public function getIsNofollow(): ?int
    {
        return $this->getInt('is_nofollow');
    }

    public function setIsNofollow(?int $value): void
    {
        $this->setAttribute('is_nofollow', $value);
    }

    public function getIsNoindex(): ?int
    {
        return $this->getInt('is_noindex');
    }

    public function setIsNoindex(?int $value): void
    {
        $this->setAttribute('is_noindex', $value);
    }
}
