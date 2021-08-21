<?php
namespace App\Domain\Role;

interface RoleRepositoryInterface
{
    public function findALl($orderByPrimaryKey = 'ASC'): array;
    public function find($id);
}
