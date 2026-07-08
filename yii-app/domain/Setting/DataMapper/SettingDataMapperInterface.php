<?php

namespace domain\Setting\DataMapper;

use domain\Setting\Entity\Setting;
use domain\Shared\DataMapper\DataMapperInterface;
use domain\Shared\Entity\AbstractEntity;

interface SettingDataMapperInterface extends DataMapperInterface
{
    public function toEntity(object $record): Setting;

    public function fillRecord(object $record, AbstractEntity $entity): object;
}
