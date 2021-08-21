<?php

namespace App\Domain\User;

use App\Domain\Role\Role;

/**
 * Class User
 * @package App\Domain\User
 */
class User
{
    /** @var int $id */
    private int $id;

    /** @var string $name */
    private string $name;

    /** @var string $email */
    private string $email;

    /** @var Role $role */
    private Role $role;

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param Role $role
     */
    private function __construct(int $id, string $name, string $email, Role $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @param Role $role
     * @return User
     */
    public static function create(int $id, string $name, string $email, Role $role): User
    {
        return new self($id, $name, $email, $role);
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
