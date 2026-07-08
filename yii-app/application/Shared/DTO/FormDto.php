<?php

namespace application\Shared\DTO;

class FormDto
{
    private object $model;

    /** @var array<string, object> */
    private array $relatedModels;

    public function __construct(object $model, array $relatedModels = [])
    {
        $this->model = $model;
        $this->relatedModels = $relatedModels;
    }

    public function getModel(): object
    {
        return $this->model;
    }

    public function getRelatedModels(): array
    {
        return $this->relatedModels;
    }
}
