<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Form\PermissionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddPermissionController extends AbstractController
{
    #[Route('/add-permission', name: 'app_add_permission')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $permission = new Permission();
        $form = $this->createForm(PermissionType::class, $permission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $permission = $form->getData();
            $entityManager->persist($permission);
            $entityManager->flush();

            return $this->redirectToRoute('app_add_permission_succes');
        }

        return $this->render('add/permission.html.twig', [
            'title' => 'SDS- Ajout d\'un bâtiment',
            'form' => $form->createView(),

        ]);
    }
}
