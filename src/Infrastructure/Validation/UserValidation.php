<?php

namespace App\Infrastructure\Validation;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validation;

class UserValidation
{
    public static function createUser(Request $request): void
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($request->get('name'), [
            new Assert\NotBlank(),
            new Assert\Length(['min' => 1, 'max' => 3]),
        ]);

        if (0 !== count($violations)) {
            throw new ValidatorException($violations);
        }

        $violations = $validator->validate($request->get('email'), [
            new Assert\Email()
        ]);

        if (0 !== count($violations)) {
            throw new ValidatorException($violations);
        }
    }


    public static function editUser(): array
    {
        return [];

    }
}
