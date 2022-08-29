<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddStructureSuccessController extends AbstractController
{
    #[Route('/add-structure-success', name: 'app_add_structure_success')]
    public function index(): Response
    {
        return $this->render('add/structure-success.html.twig', [
            'title' => 'Dantabase - Succés ajout d\'une structure',
        ]);
    }
}
