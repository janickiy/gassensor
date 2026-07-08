<?php

namespace domain\OrderProduct\Entity;

use domain\Shared\Entity\AbstractEntity;

class OrderProduct extends AbstractEntity
{
    public function getOrderId(): ?int
    {
        return $this->getInt('order_id');
    }

    public function setOrderId(?int $value): void
    {
        $this->setAttribute('order_id', $value);
    }

    public function getProductId(): ?int
    {
        return $this->getInt('product_id');
    }

    public function setProductId(?int $value): void
    {
        $this->setAttribute('product_id', $value);
    }

    public function getProductInfo(): ?string
    {
        return $this->getString('product_info');
    }

    public function setProductInfo(?string $value): void
    {
        $this->setAttribute('product_info', $value);
    }

    public function getCount(): ?int
    {
        return $this->getInt('count');
    }

    public function setCount(?int $value): void
    {
        $this->setAttribute('count', $value);
    }

    public function getPrice(): ?float
    {
        return $this->getFloat('price');
    }

    public function setPrice(?float $value): void
    {
        $this->setAttribute('price', $value);
    }

}
