<?php

namespace App\Domain;

/**
 * Interface UserRepositoryInterface
 * @package App\Domain
 */
interface UserRepositoryInterface
{
    public function findAll($orderByPrimaryKey = 'ASC'): array;

    public function find($id); //TODO: add : ?User if through serializer
}
