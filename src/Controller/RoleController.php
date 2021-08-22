<?php

namespace App\Controller;

use App\Application\Role\GetAllRoles;
use App\Domain\Role;
use App\Serializer\RoleSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends AbstractController
{
    /**
     * @Route("/roles/all", name="rolesAll")
     *
     * @param GetAllRoles $getAllRoles
     * @param RoleSerializer $roleSerializer
     * @return Response
     */
    public function getRoles(GetAllRoles $getAllRoles, RoleSerializer $roleSerializer): Response
    {
        $roles = $getAllRoles->request();
        
        return $this->render('role/roles.html.twig', [
            'roles' => array_map(function (Role $role) use ($roleSerializer): array {
                return $roleSerializer->serializeSingle($role);
            }, $roles)
        ]);
    }
}
