<?php

namespace domain\Gaz\Entity;

use domain\Shared\Entity\AbstractEntity;

class Gaz extends AbstractEntity
{
    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function setId(?int $value): void
    {
        $this->setAttribute('id', $value);
    }

    public function getTitle(): ?string
    {
        return $this->getString('title');
    }

    public function setTitle(?string $value): void
    {
        $this->setAttribute('title', $value);
    }

    public function getWeight(): ?float
    {
        return $this->getFloat('weight');
    }

    public function setWeight(?float $value): void
    {
        $this->setAttribute('weight', $value);
    }

    public function getChemicalFormula(): ?string
    {
        return $this->getString('chemical_formula');
    }

    public function setChemicalFormula(?string $value): void
    {
        $this->setAttribute('chemical_formula', $value);
    }

    public function getChemicalFormulaHtml(): ?string
    {
        return $this->getString('chemical_formula_html');
    }

    public function setChemicalFormulaHtml(?string $value): void
    {
        $this->setAttribute('chemical_formula_html', $value);
    }

    public function getSlug(): ?string
    {
        return $this->getString('slug');
    }

    public function setSlug(?string $value): void
    {
        $this->setAttribute('slug', $value);
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
