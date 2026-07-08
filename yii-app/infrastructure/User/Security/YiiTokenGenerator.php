<?php

namespace infrastructure\User\Security;

use application\User\Security\TokenGeneratorInterface;
use Yii;

class YiiTokenGenerator implements TokenGeneratorInterface
{
    public function generate(int $length = 32): string
    {
        return Yii::$app->security->generateRandomString($length);
    }
}
