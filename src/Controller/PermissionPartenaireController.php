<?php

namespace App\Controller;

use App\Entity\Permission;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermissionPartenaireController extends AbstractController
{
    #[Route('/login-partenaire/permission/{id}', name: 'app_permission_partenaire')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {

        $permission = $doctrine->getRepository(Permission::class)->find($id);

        return $this->render('structure/permission-partenaire.html.twig', [
            'title' => 'Dantabase - Bâtiment de l\'entreprise',
            'permission' => $permission,        ]);
    }
}
