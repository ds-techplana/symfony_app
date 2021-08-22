<?php

namespace App\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class UpdateUser
 * @package App\Infrastructure\DTO
 */
class UpdateUser
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
     * @var string
     */
    private string $email;

    /**
     * @var int
     */
    private int $role;

    /**
     * UpdateUser constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param int $role
     */
    private function __construct(int $id, string $name, string $email, int $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }

    /**
     * @param Request $request
     * @return UpdateUser
     */
    public static function create(Request $request): UpdateUser
    {
        return new self(
            $request->get('id'),
            $request->get('name'),
            $request->get('email'),
            $request->get('role'),
        );
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function role()
    {
        return $this->role;
    }
}
