<?php

namespace App\Serializer;

use App\Domain\Role;

/**
 * Class RoleSerializer
 * @package App\Serializer
 */
class RoleSerializer
{

    /**
     * @param Role $role
     * @return array
     */
    public function serializeSingle(Role $role): array
    {
        return [
            'id' => $role->getId(),
            'name' => $role->getName()
        ];
    }
}
