<?php

namespace App\Serializer;

use App\Domain\User;

/**
 * Class UserSerializer
 * @package App\Serializer
 */
class UserSerializer
{
    /**
     * @var RoleSerializer
     */
    private RoleSerializer $roleSerializer;

    /**
     * UserSerializer constructor.
     * @param RoleSerializer $roleSerializer
     */
    public function __construct(RoleSerializer $roleSerializer)
    {
        $this->roleSerializer = $roleSerializer;
    }

    /**
     * @param User|null $user
     * @return array
     */
    public function serializeSingle(User $user): array
    {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'role' => $this->roleSerializer->serializeSingle($user->getRole())
        ];
    }
}
