<?php

namespace domain\Order\Entity;

use domain\Shared\Entity\AbstractEntity;

class Order extends AbstractEntity
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

    public function getStatus(): ?int
    {
        return $this->getInt('status');
    }

    public function setStatus(?int $value): void
    {
        $this->setAttribute('status', $value);
    }

    public function getName(): ?string
    {
        return $this->getString('name');
    }

    public function setName(?string $value): void
    {
        $this->setAttribute('name', $value);
    }

    public function getEmail(): ?string
    {
        return $this->getString('email');
    }

    public function setEmail(?string $value): void
    {
        $this->setAttribute('email', $value);
    }

    public function getPhone(): ?string
    {
        return $this->getString('phone');
    }

    public function setPhone(?string $value): void
    {
        $this->setAttribute('phone', $value);
    }

    public function getDeliveryInfo(): ?string
    {
        return $this->getString('delivery_info');
    }

    public function setDeliveryInfo(?string $value): void
    {
        $this->setAttribute('delivery_info', $value);
    }

    public function getComment(): ?string
    {
        return $this->getString('comment');
    }

    public function setComment(?string $value): void
    {
        $this->setAttribute('comment', $value);
    }

}
