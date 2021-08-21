<?php
namespace App\Domain;

/**
 * Interface RoleRepositoryInterface
 * @package App\Domain
 */
interface RoleRepositoryInterface
{
    public function findALl($orderByPrimaryKey = 'ASC'): array;
    public function find($id);
}
