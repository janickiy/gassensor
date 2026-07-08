<?php

namespace infrastructure\User\Security;

use application\User\Security\PasswordHasherInterface;
use Yii;

class YiiPasswordHasher implements PasswordHasherInterface
{
    public function hash(string $password): string
    {
        return Yii::$app->security->generatePasswordHash($password);
    }
}
