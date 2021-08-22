<?php

namespace App\Application\Role;


use App\Domain\RoleRepositoryInterface;

/**
 * Class GetAllRoles
 * @package App\Application\Role
 */
class GetAllRoles
{
    /** @var RoleRepositoryInterface $roleRepository */
    private RoleRepositoryInterface $roleRepository;

    /**
     * GetAllRoles constructor.
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return mixed
     */
    public function request()
    {
        return $this->roleRepository->findAll();
    }
}
