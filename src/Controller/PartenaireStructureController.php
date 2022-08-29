<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Entity\Permission;
use App\Entity\Structure;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireStructureController extends AbstractController
{
    #[Route('/login-structure/partenaire/{id}', name: 'app_partenaire_structure')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $user = $this->getUser();
        $structure = $doctrine->getRepository(Structure::class)->findAll();
        $permissions = $doctrine->getRepository(Permission::class)->countPermission();
        $partenaire = $doctrine->getRepository(Partenaire::class)->find($id);

        return $this->render('structure/partenaire-structure.html.twig', [
            'title' => 'Dantabase - Votre Franchise',
            'partenaire' => $partenaire,
            'user' => $user,
            'structure' => $structure,
            'permission' => $permissions[0][1],
        ]);
    }
}
