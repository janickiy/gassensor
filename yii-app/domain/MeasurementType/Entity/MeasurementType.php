<?php

namespace domain\MeasurementType\Entity;

use domain\Shared\Entity\AbstractEntity;

class MeasurementType extends AbstractEntity
{
    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function getName(): ?string
    {
        return $this->getString('name');
    }

    public function setName(?string $name): void
    {
        $this->setAttribute('name', $name);
    }
}
