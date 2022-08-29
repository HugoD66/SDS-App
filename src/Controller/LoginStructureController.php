<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginStructureController extends AbstractController
{
    #[Route(path: '/login-structure', name: 'app_login_structure')]
    public function loginPartenaire(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('registration/login-structure.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'structure' => 'app_structure_provider',
            'title' => 'Dantabase - Connexion Structure',
        ]);
    }

    #[Route(path: '/logout-partenaire', name: 'app_logout_partenaire')]
    public function logoutPartenaire(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
