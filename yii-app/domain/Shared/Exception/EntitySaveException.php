<?php

namespace domain\Shared\Exception;

class EntitySaveException extends DomainException
{
    public static function forEntity(string $entityName): self
    {
        return new self("{$entityName} could not be saved.");
    }
}
