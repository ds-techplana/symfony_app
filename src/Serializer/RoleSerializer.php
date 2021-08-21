<?php

namespace App\Serializer;

use App\Domain\Role;

class RoleSerializer
{

    public function serializeSingle(Role $role)
    {
        return  [
            'id' => $role->getId(),
            'name' => $role->getName()
        ];
    }
}
