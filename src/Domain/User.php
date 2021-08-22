<?php

namespace App\Domain;

use App\Domain\Role;

/**
 * Class User
 * @package App\Domain
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
     * @param string $name
     * @param string $email
     * @param Role $role
     */
    private function __construct(string $name, string $email, Role $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }

    /**
     * @param string $name
     * @param string $email
     * @param Role $role
     * @return User
     */
    public static function create(string $name, string $email, Role $role): User
    {
        return new self($name, $email, $role);
    }

    /**
     * @param string $name
     * @param string $email
     * @param \App\Domain\Role $role
     * @return User
     */
    public function update(string $name, string $email, Role $role): User
    {
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;

        return $this;
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
