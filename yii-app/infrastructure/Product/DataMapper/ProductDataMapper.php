<?php

namespace infrastructure\Product\DataMapper;

use domain\Product\DataMapper\ProductDataMapperInterface;
use domain\Product\Entity\Product;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class ProductDataMapper extends AbstractDataMapper implements ProductDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'created_at', 'updated_at', 'manufacture_id', 'name', 'img', 'pdf', 'pdf2', 'pdf3', 'price', 'slug', 'measurement_type_id', 'formfactor', 'formfactor_unit', 'range_from', 'range_to', 'range_unit', 'resolution', 'sensitivity', 'sensitivity_first', 'sensitivity_analog', 'sensitivity_digital', 'sensitivity_from', 'sensitivity_to', 'sensitivity_unit', 'response_time', 'response_time_unit', 'energy_consumption_from', 'energy_consumption_to', 'energy_consumption_unit', 'temperature_range_from', 'temperature_range_to', 'info', 'bias_voltage', 'first', 'analog', 'digital']);
    }

    public function toEntity(object $record): Product
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Product::class;
    }
}
