<?php

namespace App\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RoleAll
 * @package App\Infrastructure\DTO
 */
class RoleAll
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * RoleAll constructor.
     * @param int $id
     * @param string $name
     */
    private function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @param Request $request
     * @return RoleAll
     */
    public static function get(Request $request): RoleAll
    {
        return new self(
            $request->get('id'),
            $request->get('name')
        );
    }
}
