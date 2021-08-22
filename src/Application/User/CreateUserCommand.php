<?php

namespace App\Application\User;

use App\Domain\RoleRepositoryInterface;
use App\Domain\User;
use App\Infrastructure\DTO\CreateUser;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CreateUserCommand
 * @package App\Application\User
 */
class CreateUserCommand
{
    /** @var RoleRepositoryInterface $roleRepository */
    private RoleRepositoryInterface $roleRepository;

    /** @var EntityManagerInterface $entityManager */
    private EntityManagerInterface $entityManager;

    /**
     * CreateUserCommand constructor.
     * @param RoleRepositoryInterface $roleRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(RoleRepositoryInterface $roleRepository, EntityManagerInterface $entityManager)
    {
        $this->roleRepository = $roleRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param CreateUser $DTO
     * @return User
     */
    public function handle(CreateUser $DTO): User
    {
        $role = $this->roleRepository->find($DTO->role());
        $user = User::create(
            $DTO->name(),
            $DTO->email(),
            $role
        );
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
