<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddPermissionSuccesController extends AbstractController
{
    #[Route('/add-permission-succes', name: 'app_add_permission_succes')]
    public function index(): Response
    {
        return $this->render('add/permission-success.html.twig', [
            'title' => 'Dantabase - Succés Ajout Bâtiment',
        ]);
    }
}
