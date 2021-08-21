<?php

namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\User;
use App\Domain\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NoResultException;

class UserRepository implements UserRepositoryInterface
{
    /** @var EntityManagerInterface $entityManager */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll($orderByPrimaryKey = 'ASC'): array
    {
        try {
            return $this->entityManager
                ->getRepository(User::class)
                ->findAll();
        } catch (NoResultException $e) {

        }
    }

    public function find($id)
    {
//        return $this->entityManager
//            ->createQueryBuilder('u')
//            ->where('u.id = :id')
//            ->setParameters(array(
//                'id' => $id
//            ))
//            ->getQuery()
//            ->getOneOrNullResult();
    }
}
