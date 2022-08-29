<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Form\PartenaireType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddPartenaireController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }
    #[Route('/add-partenaire', name: 'app_add_partenaire')]
    public function index(Request $request,
                          EntityManagerInterface $entityManager,
                          UserPasswordHasherInterface $userPasswordHasher,
                          SluggerInterface $slugger): Response
    {
        $partenaire = new Partenaire();
        $form = $this->createForm(PartenaireType::class, $partenaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Hash pass
            $partenaire->setPassword(
                $userPasswordHasher->hashPassword(
                    $partenaire,
                    $form->get('password')->getData()
                )
            );
            //picture
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
            //Email
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $partenaire,
                (new TemplatedEmail())
                    ->from(new Address('Dantabase@gmail.com', 'Enregistrement d\'un partenaire'))
                    ->to($partenaire->getEmail())
                    ->subject('Confirmez votre adresse mail')
                    ->htmlTemplate('mail/add-structure.html.twig')
            );
            return $this->redirectToRoute('app_add_partenaire_succes');

        }
        return $this->render('add/partenaire.html.twig', [
            'form' => $form->createView(),
            'title' => 'Dantabase - Ajout de l\'entreprise',
        ]);
    }
}
