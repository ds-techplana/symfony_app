<?php

namespace App\Domain;

/**
 * Class Role
 * @package App\Domain
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
