<?php

namespace App\Domain;

/**
 * Interface RoleRepositoryInterface
 * @package App\Domain
 */
interface RoleRepositoryInterface
{
    /**
     * @param string $orderByPrimaryKey
     * @return array
     */
    public function findALl($orderByPrimaryKey = 'ASC'): array;

    /**
     * @param $id
     * @return Role|null
     */
    public function find($id): ?Role;

    /**
     * @param $name
     * @return Role|null
     */
    public function findByName($name): ?Role;
}
