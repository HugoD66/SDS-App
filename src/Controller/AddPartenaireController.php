<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Form\PartenaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddPartenaireController extends AbstractController
{
    #[Route('/add-partenaire', name: 'app_add_partenaire')]
    public function index(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $partenaire = new Partenaire();
        $form = $this->createForm(PartenaireType::class, $partenaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $logo = $form->get('logo')->getData();
            if ($logo) {
                $originalFilename = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $logo->guessExtension();
                try {
                    $logo->move(
                        $this->getParameter('recipe-picture'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $partenaire->setLogo($newFilename);
                $partenaire->setRoles(['ROLE_PARTENAIRE']);

                $partenaire = $form->getData();

                $entityManager->persist($partenaire);
                $entityManager->flush();
            }
            return $this->redirectToRoute('app_add_partenaire_succes');

        }
        return $this->render('add/partenaire.html.twig', [
            'form' => $form->createView(),
            'title' => 'Ajout de l\'entreprise',
        ]);
    }
}
