<?php

namespace App\Domain;

/**
 * Interface UserRepositoryInterface
 * @package App\Domain
 */
interface UserRepositoryInterface
{
    /**
     * @param string $orderByPrimaryKey
     * @return array
     */
    public function findAll($orderByPrimaryKey = 'ASC'): array;

    /**
     * @param $id
     * @return User|null
     */
    public function find($id): ?User;
}
