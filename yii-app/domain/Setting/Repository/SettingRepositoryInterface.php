<?php

namespace domain\Setting\Repository;

use domain\Setting\Entity\Setting;

interface SettingRepositoryInterface
{
    public function get(int $id): Setting;

    public function findByName(string $name): ?Setting;

    public function save(Setting $entity): Setting;

    public function delete(int $id): void;

    public function deleteMany(array $ids): int;
}
