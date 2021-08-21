<?php

namespace App\Domain\User;

/**
 * Interface UserRepositoryInterface
 * @package App\Domain\User
 */
interface UserRepositoryInterface
{
    public function findAll($orderByPrimaryKey = 'ASC'): array;

    public function find($id); //TODO: add : ?User if through serializer
}
