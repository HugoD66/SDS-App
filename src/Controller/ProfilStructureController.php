<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Entity\Structure;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilStructureController extends AbstractController
{
    #[Route('/login-structure/profil/{id}', name: 'app_profil_structure')]
    public function index(Request $request, ManagerRegistry $doctrine,int $id): Response
    {
        $user = $this->getUser();
        $structure = $doctrine->getRepository(Structure::class)->find($id);
        $permission = $doctrine->getRepository(Permission::class)->findAll();

        return $this->render('profil/profil-structure.html.twig', [
            'title' => 'Dantabase - Gestion de compte',
            'structure' => $structure,
            'permissions' => $permission,
        ]);
    }
}
