<?php

namespace App\Controller;

use App\Entity\Permission;

use App\Form\PermissionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermissionController extends AbstractController
{
    #[Route('/permission/{id}', name: 'app_permission')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {

        $permission = $doctrine->getRepository(Permission::class)->find($id);



        return $this->render('structure/permission-id.html.twig', [
            'title' => 'SDS- Bâtiment de l\'entreprise',
            'permission' => $permission,
        ]);
    }

    #[Route('/permission/update/{id}', name: 'app_update_permission')]
    public function update(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $permission = $doctrine->getRepository(Permission::class)->find($id);

        $entityManager = $doctrine->getManager();
        $permissionUpdate = $entityManager->getRepository(Permission::class)->find($id);

        $form = $this->createForm(PermissionType::class, $permissionUpdate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $permissionUpdate = $form->getData();
            $entityManager->persist($permissionUpdate);
            $entityManager->flush();
        }



        return $this->render('update/update-permission.html.twig', [
            'form' => $form->createView(),
            'title' => 'SDS- Bâtiment de l\'entreprise',
            'permissionUpdate' => $permissionUpdate,
            'permission' => $permission,

        ]);
    }





}
