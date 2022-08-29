<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Entity\Structure;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListePermissionStructureController extends AbstractController
{
    #[Route('/login-structure/liste-permissions', name: 'app_liste_permission_structure')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $permission = $doctrine->getRepository(Permission::class)->findAll();
        $structure = $doctrine->getRepository(Structure::class)->findAll();

        $permissionIsActive = $doctrine->getRepository(Permission::class)->getActivatedPermissions();

        return $this->render('liste/liste-permission-structure.html.twig', [
            'title' => 'Dantabase - Liste des établissements',
            'permissions' => $permission,
            'structure' => $structure,
            'permissionIsActive' => $permissionIsActive,
        ]);
    }
}
