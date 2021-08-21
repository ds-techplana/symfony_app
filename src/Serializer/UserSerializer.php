<?php

namespace App\Serializer;

use App\Domain\User;

class UserSerializer
{
    private RoleSerializer $roleSerializer;

    public function __construct(RoleSerializer $roleSerializer)
    {
        $this->roleSerializer = $roleSerializer;
    }

    public function serializeSingle(User $user)
    {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'role' => $this->roleSerializer->serializeSingle($user->getRole())
        ];
    }
}
