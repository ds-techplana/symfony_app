<?php

namespace App\Application\User;

use App\Domain\RoleRepositoryInterface;
use App\Domain\User;
use App\Domain\UserRepositoryInterface;
use App\Infrastructure\DTO\UpdateUser;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UpdateUserCommand
 * @package App\Application\User
 */
class UpdateUserCommand
{
    /** @var UserRepositoryInterface $userRepository */
    private UserRepositoryInterface $userRepository;

    /** @var RoleRepositoryInterface $roleRepository */
    private RoleRepositoryInterface $roleRepository;

    /** @var EntityManagerInterface $entityManager */
    private EntityManagerInterface $entityManager;

    /**
     * UpdateUserCommand constructor.
     * @param UserRepositoryInterface $userRepository
     * @param RoleRepositoryInterface $roleRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param UpdateUser $DTO
     * @return User
     */
    public function handle(UpdateUser $DTO): User
    {
        $user = $this->userRepository->find($DTO->id());
        $role = $this->roleRepository->find($DTO->role());
        $user->update($DTO->name(), $DTO->email(), $role);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
