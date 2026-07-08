<?php

namespace infrastructure\Setting\DataMapper;

use domain\Setting\DataMapper\SettingDataMapperInterface;
use domain\Setting\Entity\Setting;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class SettingDataMapper extends AbstractDataMapper implements SettingDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'created_at', 'updated_at', 'name', 'value', 'description']);
    }

    public function toEntity(object $record): Setting
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return Setting::class;
    }
}
