<?php

namespace application\User\Service;

use application\User\Form\UserFormModelProviderInterface;
use application\User\Security\PasswordHasherInterface;
use application\User\Security\RoleAssignerInterface;
use application\User\Security\TokenGeneratorInterface;
use application\Shared\DTO\CrudResultDto;
use application\Shared\Service\CrudService;
use domain\User\DataMapper\UserDataMapperInterface;
use domain\User\Entity\User;
use domain\User\Repository\UserRepositoryInterface;
use RuntimeException;

class UserService extends CrudService
{
    private UserRepositoryInterface $userRepository;
    private PasswordHasherInterface $passwordHasher;
    private TokenGeneratorInterface $tokenGenerator;
    private RoleAssignerInterface $roleAssigner;

    public function __construct(
        UserRepositoryInterface $repository,
        UserDataMapperInterface $dataMapper,
        UserFormModelProviderInterface $formModelProvider,
        PasswordHasherInterface $passwordHasher,
        TokenGeneratorInterface $tokenGenerator,
        RoleAssignerInterface $roleAssigner
    ) {
        $this->userRepository = $repository;
        $this->passwordHasher = $passwordHasher;
        $this->tokenGenerator = $tokenGenerator;
        $this->roleAssigner = $roleAssigner;
        parent::__construct($repository, $dataMapper, $formModelProvider);
    }

    public function createFromForm(object $form): CrudResultDto
    {
        foreach (['name', 'username', 'email', 'password', 'role'] as $property) {
            if (!property_exists($form, $property)) {
                throw new RuntimeException("User form property {$property} was not found.");
            }
        }

        $now = time();
        $user = new User([
            'name' => (string)$form->name,
            'phone' => (string)$form->phone,
            'username' => (string)$form->username,
            'email' => (string)$form->email,
            'status' => User::STATUS_ACTIVE,
            'auth_key' => $this->tokenGenerator->generate(32),
            'password_hash' => $this->passwordHasher->hash((string)$form->password),
            'verification_token' => $this->tokenGenerator->generate(32),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $savedUser = $this->userRepository->save($user);
        $userId = $savedUser->getId();
        if ($userId === null) {
            throw new RuntimeException('Saved user id is empty.');
        }

        $this->roleAssigner->assign($userId, (string)$form->role);

        return CrudResultDto::fromEntity($savedUser);
    }

    public function deleteWithRoles(int $id): void
    {
        $this->roleAssigner->revokeAll($id);
        $this->delete($id);
    }
}
