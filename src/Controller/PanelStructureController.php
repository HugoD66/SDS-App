<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Entity\Permission;
use App\Entity\Structure;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanelStructureController extends AbstractController
{
    #[Route('/login-structure/panel', name: 'app_panel_structure')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $partenaireUser = $this->getUser(Partenaire::class);

        $structure = $doctrine->getRepository(Structure::class)->findAll();
        $permissions = $doctrine->getRepository(Permission::class)->countPermission();

        $partenaire = $doctrine->getRepository(Partenaire::class)->find(1);


        return $this->render('panel/panel-structure.html.twig', [
            'title' => 'Dantabase - Page d\'Acceuil',
            'partenaire' => $partenaire,
            'user' => $user,
            'structure' => $structure,
            'permission' => $permissions[0][1],
        ]);
    }
}
