<?php

namespace infrastructure\User\Security;

use application\User\Security\RoleAssignerInterface;
use RuntimeException;
use Yii;

class YiiRoleAssigner implements RoleAssignerInterface
{
    public function assign(int $userId, string $roleName): void
    {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($userId);
        $role = $auth->getRole($roleName);
        if ($role === null) {
            throw new RuntimeException("Role {$roleName} was not found.");
        }

        $auth->assign($role, $userId);
    }

    public function revokeAll(int $userId): void
    {
        Yii::$app->authManager->revokeAll($userId);
    }
}
