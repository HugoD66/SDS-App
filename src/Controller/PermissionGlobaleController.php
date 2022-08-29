<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Form\GlobalePermissionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermissionGlobaleController extends AbstractController
{
    #[Route('/permission-globale', name: 'app_permission_globale')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $permission = $doctrine->getRepository(Permission::class)->findAll();
        $entityManager = $doctrine->getManager();


        $form = $this->createForm(GlobalePermissionType::class, $permission);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $permission = $form->getData();
            $entityManager->persist($permission);
            $entityManager->flush();

        }

        return $this->render('permission_globale/permissions-globales.html.twig', [
            'form' => $form->createView(),
            'permission' => $permission,
            'title' => 'Dantabase - Permissions Globales',
        ]);
    }
}
