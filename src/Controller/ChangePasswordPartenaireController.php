<?php

namespace App\Controller;

use App\Form\ChangePasswordPartenaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ChangePasswordPartenaireController extends AbstractController
{
    #[Route('/change-password-partenaire', name: 'app_change_password_partenaire')]
    public function indexPartenaire(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $partenaire = $this->getUser();

        $form = $this->createForm(ChangePasswordPartenaireType::class, $partenaire);
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
            }
            // encode the plain password
                $partenaire->setPassword(
                    $userPasswordHasher->hashPassword(
                        $partenaire,
                        $form->get('plainPassword')->getData()
                    )
                );


            $entityManager->persist($partenaire);
            $entityManager->flush();
        }

        return $this->render('registration/change-password-partenaire.html.twig', [
            'title' => 'Actualisation MDP',
            'partenaire' => $partenaire,
            'form' => $form->createView(),
        ]);

    }
}