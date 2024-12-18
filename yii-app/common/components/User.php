<?php
/**
 *
 * @since 2021-10-08 14:22
 */

namespace common\components;

/**
 *
 * @property \common\models\User $identity
 *
 */
class User extends \yii\web\User
{
    public function isAdmin()
    {
        return $this->can(ROLE_NAME_ADMIN);
    }

    public function isManager()
    {
        return $this->can(ROLE_NAME_MANAGER);
    }

    public function isDeveloper()
    {
        return $this->can(ROLE_NAME_DEVELOPER);
    }
}