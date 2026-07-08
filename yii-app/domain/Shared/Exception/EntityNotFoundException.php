<?php

namespace domain\Shared\Exception;

class EntityNotFoundException extends DomainException
{
    public static function forId(string $entityName, int $id): self
    {
        return new self("{$entityName} with id {$id} was not found.");
    }
}
