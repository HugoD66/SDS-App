<?php

namespace App\Controller;

use App\Entity\Partenaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginPartenaireController extends AbstractController
{
    #[Route(path: '/login-partenaire', name: 'app_login_partenaire')]
    public function loginPartenaire(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('registration/login-partenaire.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'partenaire' => 'app_partenaire_provider',
            'title' => 'Dantabase - Connxion Franchise',
        ]);
    }

    #[Route(path: '/logout-partenaire', name: 'app_logout_partenaire')]
    public function logoutPartenaire(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
