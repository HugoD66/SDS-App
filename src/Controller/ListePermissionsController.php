<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Entity\Structure;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListePermissionsController extends AbstractController
{
    #[Route('/permissions', name: 'app_liste_permissions')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $permission = $doctrine->getRepository(Permission::class)->findAll();
        $structure = $doctrine->getRepository(Structure::class)->findAll();

        return $this->render('liste/liste-permissions.html.twig', [
            'title' => 'SDS- Liste des établissements',
            'permissions' => $permission,
            'structure' => $structure,
        ]);
    }
}
