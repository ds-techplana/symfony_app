<?php

namespace App\Domain\Role;

/**
 * Class Role
 * @package App\Domain\Role
 */
class Role
{
    /** @var int $id */
    private int $id;

    /** @var string $name */
    private string $name;

    /**
     * Role constructor.
     * @param int $id
     * @param string $name
     */
    private function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @param int $id
     * @param string $name
     * @return Role
     */
    public static function create(int $id, string $name): Role
    {
        return new self($id, $name);
    }

}
