<?php

namespace App\Controller;

use App\Form\ChangePasswordPartenaireType;
use App\Form\ChangePasswordStructureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ChangePasswordStructureController extends AbstractController
{
    #[Route('/login-structure/change-password-structure', name: 'app_change_password_structure')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $structure = $this->getUser();

        $form = $this->createForm(ChangePasswordStructureType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logo = $form->get('logo_structure')->getData();
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
                $structure->setLogoStructure($newFilename);
            }
            // encode the plain password
            $structure->setPassword(
                $userPasswordHasher->hashPassword(
                    $structure,
                    $form->get('plainPassword')->getData()
                )
            );


            $entityManager->persist($structure);
            $entityManager->flush();
        }


        return $this->render('registration/change-password-structure.html.twig', [
            'title' => 'Dantabase - Actualisation MDP',
            'partenaire' => $structure,
            'form' => $form->createView(),
        ]);
    }
}
