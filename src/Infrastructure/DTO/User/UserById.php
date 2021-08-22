<?php

namespace App\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserById
 * @package App\Infrastructure\DTO
 */
class UserById
{
    /**
     * @var int
     */
    private int $id;

    /**
     * UserById constructor.
     * @param int $id
     */
    private function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param Request $request
     * @return UserById
     */
    public static function create(Request $request): UserById
    {
        return new self(
            $request->get('id')
        );
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }
}
