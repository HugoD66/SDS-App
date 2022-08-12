<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Form\PartenaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddPartenaireController extends AbstractController
{
    #[Route('/add-partenaire', name: 'app_add_partenaire')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $partenaire = new Partenaire();
        $form = $this->createForm(PartenaireType::class, $partenaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $contactus = $form->getData();

            $entityManager->persist($contactus);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');

        }
        return $this->render('add/partenaire.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
