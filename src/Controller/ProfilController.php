<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil')]
    public function index(int $id): Response
    {
        $user = $this->getUser();

        return $this->render('profil/profil.twig', [
            'user' => $user,
        ]);
    }
}
