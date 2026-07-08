<?php

namespace application\User\Security;

interface RoleAssignerInterface
{
    public function assign(int $userId, string $roleName): void;

    public function revokeAll(int $userId): void;
}
