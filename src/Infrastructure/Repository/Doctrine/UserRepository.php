<?php

namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\User;
use App\Domain\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UserRepository
 * @package App\Infrastructure\Repository\Doctrine
 */
class UserRepository implements UserRepositoryInterface
{
    /** @var EntityManagerInterface $entityManager */
    private EntityManagerInterface $entityManager;

    /**
     * UserRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $order
     * @param string $orderBy
     * @return array
     */
    public function findAll($order = 'ASC', $orderBy = 'id'): array
    {
        return $this->entityManager
            ->getRepository(User::class)
            ->findBy([], [
                $orderBy => $order
            ]);
    }

    /**
     * @param $id
     * @return User|null
     */
    public function find($id): ?User
    {
        return $this->entityManager
            ->getRepository(User::class)
            ->find($id);
    }
}
