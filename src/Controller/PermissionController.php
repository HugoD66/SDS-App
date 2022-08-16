<?php

namespace App\Controller;

use App\Entity\Permission;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermissionController extends AbstractController
{
    #[Route('/permission/{id}', name: 'app_permission')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {

        $permission = $doctrine->getRepository(Permission::class)->find($id);



        return $this->render('structure/permission-id.html.twig', [
            'title' => 'SDS- Bâtiment de l\'entreprise',
            'permission' => $permission,
        ]);
    }
}
