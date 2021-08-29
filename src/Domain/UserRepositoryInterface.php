<?php

namespace App\Domain;

/**
 * Interface UserRepositoryInterface
 * @package App\Domain
 */
interface UserRepositoryInterface
{
    /**
     * @param string $order
     * @param string $orderBy
     * @return array
     */
    public function findAll($order = 'ASC', $orderBy = 'id'): array;

    /**
     * @param $id
     * @return User|null
     */
    public function find($id): ?User;
}
