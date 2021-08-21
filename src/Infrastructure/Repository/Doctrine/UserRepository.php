<?php

namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\User\UserRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class User extends EntityRepository implements UserRepositoryInterface
{
    public function getAllUsers($orderByPrimaryKey = 'ASC'): array
    {
        return $this->createQueryBuilder('user')
            ->getQuery()
            ->getResult();
    }

    public function getUserById()
    {
        // TODO: Implement getUserById() method.
    }
}
