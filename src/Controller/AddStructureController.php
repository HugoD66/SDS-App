<?php

namespace App\Controller;

use App\Entity\Structure;
use App\Form\PartenaireType;
use App\Form\StructureType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddStructureController extends AbstractController
{

    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }


    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    #[Route('/add-structure', name: 'app_add_structure')]
    public function index(Request $request,
                          EntityManagerInterface $entityManager,
                          UserPasswordHasherInterface $userPasswordHasher,
                          SluggerInterface $slugger,
                          MailerInterface $mailer): Response
    {
        $structure = new Structure();
        $form = $this->createForm(StructureType::class, $structure);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Hash pass
            $structure->setPassword(
                $userPasswordHasher->hashPassword(
                    $structure,
                    $form->get('plainPassword')->getData()
                )
            );
            //Picture
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
                $structure->setRoles(['ROLE_STRUCTURE']);
                $structure = $form->getData();
            }
            $entityManager->persist($structure);
            $entityManager->flush();
            //Email Directeur Structure
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $structure,
                (new TemplatedEmail())
                    ->from(new Address('Dantabase@gmail.com', 'Enregistrement d\'une structure'))
                    ->to($structure->getEmail())
                    ->subject('Confirmez votre adresse mail')
                    ->htmlTemplate('mail/add-structure.html.twig')
            );
            //Email Directeur Franchise
            $mailer->send(
                (new TemplatedEmail())
                    ->from('Dantabase@gmail.com')
                    ->to($structure->getClientId()->getEmail())
                    ->subject('Notif. nouvelle structure')
                    ->htmlTemplate('mail/notif-partenaire-newstructure.html.twig')
            );



            return $this->redirectToRoute('app_add_structure_success');
        }
        return $this->render('add/structure.html.twig', [
            'title' => 'Dantabase - Ajout Structure',
            'form' => $form->createView(),
        ]);
    }
}
