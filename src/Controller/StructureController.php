<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Entity\Structure;
use ContainerAiukBHX\getListePermissionsControllerService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StructureController extends AbstractController
{
    #[Route('/structure/{id}', name: 'app_structure')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $structure = $doctrine->getRepository(Structure::class)->find($id);
        $permission = $doctrine->getRepository(Permission::class)->findAll();


        return $this->render('structure/structure-id.html.twig', [
            'title' => 'SDS- Structure de l\'entreprise',
            'structure' => $structure,
            'permissions' => $permission,
            ]);
    }
}
