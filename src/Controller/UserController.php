<?php

namespace App\Controller;

use App\Domain\User;
use App\Serializer\UserSerializer;
use App\Application\User\GetAllUsers;
use Domain\Product\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users/all", name="users_all")
     *
     * @param GetAllUsers $getAllUsers
     * @param UserSerializer $userSerializer
     * @return Response
     */
    public function getUsers(GetAllUsers $getAllUsers, UserSerializer $userSerializer): Response
    {
        $users = $getAllUsers->request();

        return $this->json([
            'users' => array_map(function (User $user) use($userSerializer): array {
                return $userSerializer->serializeSingle($user);
            }, $users)
        ]);
    }
}
