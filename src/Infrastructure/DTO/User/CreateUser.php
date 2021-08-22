<?php
namespace App\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

class UserAll
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
            $request->get('name'),
            $request->get('role'),
            $request->get('role'),
        );
    }
}
