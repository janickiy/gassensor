<?php

namespace infrastructure\Shared\Form;

use application\Shared\Form\FormModelProviderInterface;
use domain\Shared\Exception\EntityNotFoundException;
use yii\base\Model;
use yii\db\ActiveRecord;

abstract class ActiveRecordFormModelProvider implements FormModelProviderInterface
{
    abstract protected function recordClass(): string;

    public function create(array $config = []): object
    {
        $class = $this->recordClass();

        return new $class($config);
    }

    public function find(int $id): object
    {
        $class = $this->recordClass();
        $model = $class::findOne($id);
        if ($model === null) {
            throw EntityNotFoundException::forId($class, $id);
        }

        return $model;
    }

    public function load(object $model, array $data, ?string $formName = null): bool
    {
        if (!$model instanceof Model) {
            return false;
        }

        return $model->load($data, $formName);
    }

    public function validate(object $model, ?array $attributeNames = null): bool
    {
        return $model instanceof Model && $model->validate($attributeNames);
    }

    public function loadDefaultValues(object $model): void
    {
        if ($model instanceof ActiveRecord) {
            $model->loadDefaultValues();
        }
    }
}
