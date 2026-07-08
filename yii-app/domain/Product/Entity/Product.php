<?php

namespace domain\Product\Entity;

use domain\Shared\Entity\AbstractEntity;

class Product extends AbstractEntity
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

    public function getUpdatedAt(): ?int
    {
        return $this->getInt('updated_at');
    }

    public function setUpdatedAt(?int $value): void
    {
        $this->setAttribute('updated_at', $value);
    }

    public function getManufactureId(): ?int
    {
        return $this->getInt('manufacture_id');
    }

    public function setManufactureId(?int $value): void
    {
        $this->setAttribute('manufacture_id', $value);
    }

    public function getName(): ?string
    {
        return $this->getString('name');
    }

    public function setName(?string $value): void
    {
        $this->setAttribute('name', $value);
    }

    public function getImg(): ?string
    {
        return $this->getString('img');
    }

    public function setImg(?string $value): void
    {
        $this->setAttribute('img', $value);
    }

    public function getPdf(): ?string
    {
        return $this->getString('pdf');
    }

    public function setPdf(?string $value): void
    {
        $this->setAttribute('pdf', $value);
    }

    public function getPdf2(): ?string
    {
        return $this->getString('pdf2');
    }

    public function setPdf2(?string $value): void
    {
        $this->setAttribute('pdf2', $value);
    }

    public function getPdf3(): ?string
    {
        return $this->getString('pdf3');
    }

    public function setPdf3(?string $value): void
    {
        $this->setAttribute('pdf3', $value);
    }

    public function getPrice(): ?float
    {
        return $this->getFloat('price');
    }

    public function setPrice(?float $value): void
    {
        $this->setAttribute('price', $value);
    }

    public function getSlug(): ?string
    {
        return $this->getString('slug');
    }

    public function setSlug(?string $value): void
    {
        $this->setAttribute('slug', $value);
    }

    public function getMeasurementTypeId(): ?int
    {
        return $this->getInt('measurement_type_id');
    }

    public function setMeasurementTypeId(?int $value): void
    {
        $this->setAttribute('measurement_type_id', $value);
    }

    public function getFormfactor(): ?string
    {
        return $this->getString('formfactor');
    }

    public function setFormfactor(?string $value): void
    {
        $this->setAttribute('formfactor', $value);
    }

    public function getFormfactorUnit(): ?string
    {
        return $this->getString('formfactor_unit');
    }

    public function setFormfactorUnit(?string $value): void
    {
        $this->setAttribute('formfactor_unit', $value);
    }

    public function getRangeFrom(): ?float
    {
        return $this->getFloat('range_from');
    }

    public function setRangeFrom(?float $value): void
    {
        $this->setAttribute('range_from', $value);
    }

    public function getRangeTo(): ?float
    {
        return $this->getFloat('range_to');
    }

    public function setRangeTo(?float $value): void
    {
        $this->setAttribute('range_to', $value);
    }

    public function getRangeUnit(): ?string
    {
        return $this->getString('range_unit');
    }

    public function setRangeUnit(?string $value): void
    {
        $this->setAttribute('range_unit', $value);
    }

    public function getResolution(): ?float
    {
        return $this->getFloat('resolution');
    }

    public function setResolution(?float $value): void
    {
        $this->setAttribute('resolution', $value);
    }

    public function getSensitivity(): ?string
    {
        return $this->getString('sensitivity');
    }

    public function setSensitivity(?string $value): void
    {
        $this->setAttribute('sensitivity', $value);
    }

    public function getSensitivityFirst(): ?string
    {
        return $this->getString('sensitivity_first');
    }

    public function setSensitivityFirst(?string $value): void
    {
        $this->setAttribute('sensitivity_first', $value);
    }

    public function getSensitivityAnalog(): ?string
    {
        return $this->getString('sensitivity_analog');
    }

    public function setSensitivityAnalog(?string $value): void
    {
        $this->setAttribute('sensitivity_analog', $value);
    }

    public function getSensitivityDigital(): ?string
    {
        return $this->getString('sensitivity_digital');
    }

    public function setSensitivityDigital(?string $value): void
    {
        $this->setAttribute('sensitivity_digital', $value);
    }

    public function getSensitivityFrom(): ?float
    {
        return $this->getFloat('sensitivity_from');
    }

    public function setSensitivityFrom(?float $value): void
    {
        $this->setAttribute('sensitivity_from', $value);
    }

    public function getSensitivityTo(): ?float
    {
        return $this->getFloat('sensitivity_to');
    }

    public function setSensitivityTo(?float $value): void
    {
        $this->setAttribute('sensitivity_to', $value);
    }

    public function getSensitivityUnit(): ?string
    {
        return $this->getString('sensitivity_unit');
    }

    public function setSensitivityUnit(?string $value): void
    {
        $this->setAttribute('sensitivity_unit', $value);
    }

    public function getResponseTime(): ?float
    {
        return $this->getFloat('response_time');
    }

    public function setResponseTime(?float $value): void
    {
        $this->setAttribute('response_time', $value);
    }

    public function getResponseTimeUnit(): ?string
    {
        return $this->getString('response_time_unit');
    }

    public function setResponseTimeUnit(?string $value): void
    {
        $this->setAttribute('response_time_unit', $value);
    }

    public function getEnergyConsumptionFrom(): ?float
    {
        return $this->getFloat('energy_consumption_from');
    }

    public function setEnergyConsumptionFrom(?float $value): void
    {
        $this->setAttribute('energy_consumption_from', $value);
    }

    public function getEnergyConsumptionTo(): ?float
    {
        return $this->getFloat('energy_consumption_to');
    }

    public function setEnergyConsumptionTo(?float $value): void
    {
        $this->setAttribute('energy_consumption_to', $value);
    }

    public function getEnergyConsumptionUnit(): ?string
    {
        return $this->getString('energy_consumption_unit');
    }

    public function setEnergyConsumptionUnit(?string $value): void
    {
        $this->setAttribute('energy_consumption_unit', $value);
    }

    public function getTemperatureRangeFrom(): ?int
    {
        return $this->getInt('temperature_range_from');
    }

    public function setTemperatureRangeFrom(?int $value): void
    {
        $this->setAttribute('temperature_range_from', $value);
    }

    public function getTemperatureRangeTo(): ?int
    {
        return $this->getInt('temperature_range_to');
    }

    public function setTemperatureRangeTo(?int $value): void
    {
        $this->setAttribute('temperature_range_to', $value);
    }

    public function getInfo(): ?string
    {
        return $this->getString('info');
    }

    public function setInfo(?string $value): void
    {
        $this->setAttribute('info', $value);
    }

    public function getBiasVoltage(): ?string
    {
        return $this->getString('bias_voltage');
    }

    public function setBiasVoltage(?string $value): void
    {
        $this->setAttribute('bias_voltage', $value);
    }

    public function getFirst(): ?int
    {
        return $this->getInt('first');
    }

    public function setFirst(?int $value): void
    {
        $this->setAttribute('first', $value);
    }

    public function getAnalog(): ?int
    {
        return $this->getInt('analog');
    }

    public function setAnalog(?int $value): void
    {
        $this->setAttribute('analog', $value);
    }

    public function getDigital(): ?int
    {
        return $this->getInt('digital');
    }

    public function setDigital(?int $value): void
    {
        $this->setAttribute('digital', $value);
    }

}
