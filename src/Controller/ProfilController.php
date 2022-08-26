<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Form\GlobalePermissionType;
use App\Form\PermissionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil')]
    public function index(Request $request, ManagerRegistry $doctrine,int $id): Response
    {
        $user = $this->getUser();




        return $this->render('profil/profil.html.twig', [
            'user' => $user,


        ]);
    }
}
