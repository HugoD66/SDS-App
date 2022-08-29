<?php

namespace App\Controller;

use App\Entity\Permission;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermissionStructureController extends AbstractController
{
    #[Route('/login-structure/permission/{id}', name: 'app_permission_structure')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {

        $permission = $doctrine->getRepository(Permission::class)->find($id);

        return $this->render('structure/permission-structure.html.twig', [
            'title' => 'Dantabase - Bâtiment de l\'entreprise',
            'permission' => $permission,
            ]);
    }
}
