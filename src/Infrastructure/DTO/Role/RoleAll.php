<?php
namespace App\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

class RoleAll
{
    private $id;
    private $name;

    private function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function create(Request $request)
    {
        return new self(
            $request->get('id'),
            $request->get('name')
        );
    }
}
