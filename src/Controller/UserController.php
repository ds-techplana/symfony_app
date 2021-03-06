<?php

namespace App\Controller;

use App\Application\Role\GetAllRoles;
use App\Application\User\CreateUserCommand;
use App\Application\User\GetUserById;
use App\Application\User\UpdateUserCommand;
use App\Domain\Role;
use App\Domain\User;
use App\Infrastructure\DTO\CreateUser;
use App\Infrastructure\DTO\UpdateUser;
use App\Infrastructure\DTO\UserById;
use App\Infrastructure\Validation\UserValidation;
use App\Serializer\RoleSerializer;
use App\Serializer\UserSerializer;
use App\Application\User\GetAllUsers;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\ValidatorException;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}/get", name="user", methods={"GET"})
     *
     * @param Request $request
     * @param GetUserById $getUserById
     * @param UserSerializer $userSerializer
     * @param RoleSerializer $roleSerializer
     * @param GetAllRoles $getAllRoles
     * @return Response
     */
    public function getSingleUser(Request $request, GetUserById $getUserById, UserSerializer $userSerializer, RoleSerializer $roleSerializer, GetAllRoles $getAllRoles): Response
    {
        $user = $getUserById->request(UserById::create($request));
        $roles = $getAllRoles->request();

        return $this->render('user/edit.user.html.twig', [
            'user' => $userSerializer->serializeSingle($user),
            'roles' => array_map(function (Role $role) use ($roleSerializer): array {
                return $roleSerializer->serializeSingle($role);
            }, $roles)
        ]);
    }

    /**
     * @Route("/users/all", name="usersAll")
     *
     * @param Request $request
     * @param GetAllUsers $getAllUsers
     * @param UserSerializer $userSerializer
     * @return Response
     */
    public function getUsers(Request $request, GetAllUsers $getAllUsers, UserSerializer $userSerializer): Response
    {
        $users = $getAllUsers->request($request);
        $order = $request->get('order');
        $orderBy = $request->get('orderBy');
        return $this->render('user/users.html.twig', [
            'orderBy' => isset($orderBy) ? $orderBy : 'name',
            'order' => isset($order) ? $order : 'ASC',
            'users' => array_map(function (User $user) use ($userSerializer): array {
                return $userSerializer->serializeSingle($user);
            }, $users)
        ]);
    }

    /**
     * @Route(path="/user/create", methods={"POST"}, name="userCreate")
     *
     * @param Request $request
     * @param CreateUserCommand $createUserCommand
     * @param RoleSerializer $roleSerializer
     * @param GetAllRoles $getAllRoles
     * @return RedirectResponse|Response
     * @throws \Doctrine\ORM\EntityNotFoundException
     */
    public function createUser(Request $request, CreateUserCommand $createUserCommand, RoleSerializer $roleSerializer, GetAllRoles $getAllRoles)
    {
        try {
            UserValidation::createUser($request);
        } catch (ValidatorException $exception) {
            $validationException = $exception;
        }

        try {
            $createUserCommand->handle(CreateUser::create($request));
        } catch (ConflictHttpException | EntityNotFoundException  $exception) {
            $validationException = $exception;
        }

        if(isset($validationException)) {
            $roles = $getAllRoles->request();

            return $this->render('user/create.user.html.twig', [
                'validationError' => $validationException,
                'roles' => array_map(function (Role $role) use ($roleSerializer): array {
                    return $roleSerializer->serializeSingle($role);
                }, $roles)
            ]);
        }

        return $this->redirectToRoute('usersAll');
    }

    /**
     * @Route(path="/user/create", methods={"GET"}, name="userNew")
     *
     * @param GetAllRoles $getAllRoles
     * @param RoleSerializer $roleSerializer
     * @return Response
     */
    public function getCreateUser(GetAllRoles $getAllRoles, RoleSerializer $roleSerializer)
    {
        $roles = $getAllRoles->request();

        return $this->render('user/create.user.html.twig', [
            'roles' => array_map(function (Role $role) use ($roleSerializer): array {
                return $roleSerializer->serializeSingle($role);
            }, $roles)
        ]);
    }

    /**
     * @Route(path="/user/edit", methods={"POST"}, name="userEdit")
     *
     * @param Request $request
     * @param UpdateUserCommand $updateUserCommand
     * @return RedirectResponse
     */
    public function editUser(Request $request, UpdateUserCommand $updateUserCommand)
    {
        UserValidation::editUser($request);
        $updateUserCommand->handle(UpdateUser::create($request));

        return $this->redirectToRoute('usersAll');
    }
}
