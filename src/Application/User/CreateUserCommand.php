<?php

namespace App\Application\User;

use App\Domain\RoleRepositoryInterface;
use App\Domain\User;
use App\Infrastructure\DTO\CreateUser;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

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
     * @throws EntityNotFoundException
     */
    public function handle(CreateUser $DTO): User
    {
        $role = $this->roleRepository->find($DTO->role());
        if (!$role) {
            throw new EntityNotFoundException('');
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['name' => $DTO->name()]);
        if ($user) {
            throw new ConflictHttpException('User with name: ' . $DTO->name() . ' already exists!');
        }

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
