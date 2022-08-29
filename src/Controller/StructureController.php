<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Entity\Structure;
use App\Form\StructureType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class StructureController extends AbstractController
{
    #[Route('/structure/{id}', name: 'app_structure')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $structure = $doctrine->getRepository(Structure::class)->find($id);
        $permission = $doctrine->getRepository(Permission::class)->findAll();


        return $this->render('structure/structure-id.html.twig', [
            'title' => 'Dantabase - Structure de l\'entreprise',
            'structure' => $structure,
            'permissions' => $permission,
            ]);
    }


    #[Route('/structure/update/{id}', name: 'app_update_structure')]
    public function update(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger, int $id, EntityManagerInterface $entityManager): Response
    {
        $structure = $doctrine->getRepository(Structure::class)->find($id);

        $entityManager = $doctrine->getManager();
        $structureUpdate = $entityManager->getRepository(Structure::class)->find($id);
        $permission = $doctrine->getRepository(Permission::class)->findAll();


        $form = $this->createForm(StructureType::class, $structureUpdate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logoStructure = $form->get('logoStructure')->getData();
            if ($logoStructure) {
                $originalFilename = pathinfo($logoStructure->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $logoStructure->guessExtension();
                try {
                    $logoStructure->move(
                        $this->getParameter('recipe-picture'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $structureUpdate->setLogoStructure($newFilename);
                $structureUpdate = $form->getData();

            }
            $entityManager->persist($structureUpdate);
            $entityManager->flush();
            return $this->redirectToRoute('app_liste_structure');

        }

        return $this->render('update/update-structure.html.twig', [
            'form' => $form->createView(),
            'title' => 'SDS- Modification Structure',
            'structureUpdate' => $structureUpdate,
            'structure' => $structure,
            'permissions' => $permission,

        ]);
    }


    #[Route('/structure/delete/{id}', name: 'app_delete_structure')]
    public function delete(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger, int $id, EntityManagerInterface $entityManager): Response
    {
        $structureRemove = $entityManager->getRepository(Structure::class)->find($id);


        $entityManager->remove($structureRemove);
        $entityManager->flush();
        return $this->redirectToRoute('app_liste_structure');

    }
}
