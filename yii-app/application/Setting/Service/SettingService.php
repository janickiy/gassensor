<?php

namespace application\Setting\Service;

use application\Setting\Form\SettingFormModelProviderInterface;
use application\Shared\Service\CrudService;
use domain\Setting\Entity\Setting;
use domain\Setting\DataMapper\SettingDataMapperInterface;
use domain\Setting\Repository\SettingRepositoryInterface;

class SettingService extends CrudService
{
    private SettingRepositoryInterface $settingRepository;

    public function __construct(
        SettingRepositoryInterface $repository,
        SettingDataMapperInterface $dataMapper,
        SettingFormModelProviderInterface $formModelProvider
    ) {
        $this->settingRepository = $repository;
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }

    public function saveValue(string $name, string $value): void
    {
        $entity = $this->settingRepository->findByName($name) ?: new Setting();
        $entity->setName($name);
        $entity->setValue($value);
        $entity->setDescription($entity->getDescription() ?: $name);

        $this->settingRepository->save($entity);
    }

    public function saveValues(array $values): int
    {
        $count = 0;
        foreach ($values as $name => $value) {
            $this->saveValue((string)$name, (string)$value);
            $count++;
        }

        return $count;
    }
}
