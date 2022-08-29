<?php

namespace App\Controller;

use App\Entity\Structure;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeStuctureStructureController extends AbstractController
{
    #[Route('/login-structure/structure', name: 'app_liste_structure_structure')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $structure = $doctrine->getRepository(Structure::class)->findAll();

        return $this->render('liste/liste-structure-structure.html.twig', [
            'title' => 'SDS- Liste des Structures',
            'structure' => $structure,
        ]);
    }
}
