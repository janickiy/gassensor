<?php

namespace application\Shared\Form;

interface FormModelProviderInterface
{
    public function create(array $config = []): object;

    public function find(int $id): object;

    public function load(object $model, array $data, ?string $formName = null): bool;

    public function validate(object $model, ?array $attributeNames = null): bool;

    public function loadDefaultValues(object $model): void;
}
