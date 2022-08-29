<?php

namespace App\Controller;

use App\Entity\Partenaire;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilPartenaireController extends AbstractController
{
    #[Route('/login-partenaire/profil/{id}', name: 'app_profil_partenaire')]
    public function index(Request $request, ManagerRegistry $doctrine,int $id): Response
    {
        $user = $this->getUser();

        $partenaire = $doctrine->getRepository(Partenaire::class)->find($id);


        return $this->render('profil/profil-partenaire.html.twig', [
            'title' => 'Dantabase - Gestion de compte',
            'user' => $user,
            'partenaire' => $partenaire,
        ]);
    }
}
