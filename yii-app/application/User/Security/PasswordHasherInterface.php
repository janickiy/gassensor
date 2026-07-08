<?php

namespace application\User\Security;

interface PasswordHasherInterface
{
    public function hash(string $password): string;
}
