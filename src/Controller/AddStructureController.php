<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\PartenaireType;
use App\Form\StructureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddStructureController extends AbstractController
{
    #[Route('/add-structure', name: 'app_add_structure')]
    public function index(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $structure = new Structure();
        $form = $this->createForm(StructureType::class, $structure);
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
                $structure->setLogoStructure($newFilename);

                $structure = $form->getData();
            }
            $entityManager->persist($structure);
            $entityManager->flush();
            return $this->redirectToRoute('app_add_structure_success');


        }
        return $this->render('add/structure.html.twig', [
            'title' => 'Dantabase - Ajout Structure',
            'form' => $form->createView(),
        ]);
    }
}
