<?php

namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\RoleRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class RoleRepository implements RoleRepositoryInterface
{
    /** @var EntityManagerInterface $entityManager */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll($orderByPrimaryKey = 'ASC'): array
    {
        // TODO: Implement getAllRoles() method.
    }

    public function find($id)
    {
        // TODO: Implement getRoleById() method.
    }
}
