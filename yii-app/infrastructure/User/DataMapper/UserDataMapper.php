<?php

namespace infrastructure\User\DataMapper;

use domain\User\DataMapper\UserDataMapperInterface;
use domain\User\Entity\User;
use infrastructure\Shared\DataMapper\AbstractDataMapper;

class UserDataMapper extends AbstractDataMapper implements UserDataMapperInterface
{
    public function __construct()
    {
        parent::__construct(['id', 'username', 'name', 'phone', 'access_token', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'status', 'created_at', 'updated_at', 'verification_token', 'telegram_chat_id']);
    }

    public function toEntity(object $record): User
    {
        return parent::toEntity($record);
    }

    protected function entityClass(): string
    {
        return User::class;
    }
}
