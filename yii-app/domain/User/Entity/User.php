<?php

namespace domain\User\Entity;

use domain\Shared\Entity\AbstractEntity;

class User extends AbstractEntity
{
    public const STATUS_DELETED = 0;
    public const STATUS_INACTIVE = 9;
    public const STATUS_ACTIVE = 10;

    public function getId(): ?int
    {
        return $this->getInt('id');
    }

    public function setId(?int $value): void
    {
        $this->setAttribute('id', $value);
    }

    public function getUsername(): ?string
    {
        return $this->getString('username');
    }

    public function setUsername(?string $value): void
    {
        $this->setAttribute('username', $value);
    }

    public function getName(): ?string
    {
        return $this->getString('name');
    }

    public function setName(?string $value): void
    {
        $this->setAttribute('name', $value);
    }

    public function getPhone(): ?string
    {
        return $this->getString('phone');
    }

    public function setPhone(?string $value): void
    {
        $this->setAttribute('phone', $value);
    }

    public function getAccessToken(): ?string
    {
        return $this->getString('access_token');
    }

    public function setAccessToken(?string $value): void
    {
        $this->setAttribute('access_token', $value);
    }

    public function getAuthKey(): ?string
    {
        return $this->getString('auth_key');
    }

    public function setAuthKey(?string $value): void
    {
        $this->setAttribute('auth_key', $value);
    }

    public function getPasswordHash(): ?string
    {
        return $this->getString('password_hash');
    }

    public function setPasswordHash(?string $value): void
    {
        $this->setAttribute('password_hash', $value);
    }

    public function getPasswordResetToken(): ?string
    {
        return $this->getString('password_reset_token');
    }

    public function setPasswordResetToken(?string $value): void
    {
        $this->setAttribute('password_reset_token', $value);
    }

    public function getEmail(): ?string
    {
        return $this->getString('email');
    }

    public function setEmail(?string $value): void
    {
        $this->setAttribute('email', $value);
    }

    public function getStatus(): ?int
    {
        return $this->getInt('status');
    }

    public function setStatus(?int $value): void
    {
        $this->setAttribute('status', $value);
    }

    public function getCreatedAt(): ?int
    {
        return $this->getInt('created_at');
    }

    public function setCreatedAt(?int $value): void
    {
        $this->setAttribute('created_at', $value);
    }

    public function getUpdatedAt(): ?int
    {
        return $this->getInt('updated_at');
    }

    public function setUpdatedAt(?int $value): void
    {
        $this->setAttribute('updated_at', $value);
    }

    public function getVerificationToken(): ?string
    {
        return $this->getString('verification_token');
    }

    public function setVerificationToken(?string $value): void
    {
        $this->setAttribute('verification_token', $value);
    }

    public function getTelegramChatId(): ?int
    {
        return $this->getInt('telegram_chat_id');
    }

    public function setTelegramChatId(?int $value): void
    {
        $this->setAttribute('telegram_chat_id', $value);
    }

}
