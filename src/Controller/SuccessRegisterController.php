<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuccessRegisterController extends AbstractController
{
    #[Route('/success/register', name: 'app_success_register')]
    public function index(): Response
    {

        return $this->render('registration/success-register.html.twig', [
            'controller_name' => 'SuccessRegisterController',
        ]);
    }
}
