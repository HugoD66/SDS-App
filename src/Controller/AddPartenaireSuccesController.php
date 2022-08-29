<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddPartenaireSuccesController extends AbstractController
{
    #[Route('/add-partenaire-succes', name: 'app_add_partenaire_succes')]
    public function index(): Response
    {


        return $this->render('add/partenaire-success.html.twig', [
            'title' => 'Dantabase - Succés Ajout Partenaire',
        ]);
    }
}
