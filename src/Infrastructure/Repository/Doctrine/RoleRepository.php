<?php

namespace App\Infrastructure\Repository\Doctrine;

use App\Domain\Role\RoleRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class RoleInterface extends EntityRepository implements RoleRepositoryInterface
{
    public function getAllRoles($orderByPrimaryKey = 'ASC')
    {
        // TODO: Implement getAllRoles() method.
    }

    public function getRoleById()
    {
        // TODO: Implement getRoleById() method.
    }
}
