<?php

namespace App\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateUser
 * @package App\Infrastructure\DTO
 */
class CreateUser
{
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
     * CreateUser constructor.
     * @param string $name
     * @param string $email
     * @param int $role
     */
    private function __construct(string $name, string $email, int $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->role = $role;
    }

    /**
     * @param Request $request
     * @return CreateUser
     */
    public static function create(Request $request): CreateUser
    {
        return new self(
            $request->get('name'),
            $request->get('email'),
            $request->get('role'),
        );
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
