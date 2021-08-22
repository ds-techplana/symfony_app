<?php

namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\Role;
use App\Domain\RoleRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;

/**
 * Class RoleRepository
 * @package App\Infrastructure\Repository\Doctrine
 */
class RoleRepository implements RoleRepositoryInterface
{
    /** @var EntityManagerInterface $entityManager */
    private EntityManagerInterface $entityManager;

    /**
     * RoleRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $orderByPrimaryKey
     * @return array
     */
    public function findAll($orderByPrimaryKey = 'ASC'): array
    {
        return $this->entityManager
            ->getRepository(Role::class)
            ->findAll();
    }

    /**
     * @param $id
     * @return Role|null
     */
    public function find($id): ?Role
    {
        return $this->entityManager
            ->getRepository(Role::class)
            ->find($id);
    }
}
