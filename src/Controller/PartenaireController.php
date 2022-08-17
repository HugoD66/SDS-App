<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Entity\Permission;
use App\Entity\Structure;
use App\Form\PartenaireType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class PartenaireController extends AbstractController
{
    #[Route('/partenaire/{id}', name: 'app_partenaire')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $user = $this->getUser();
        $structure = $doctrine->getRepository(Structure::class)->findAll();
        $permissions = $doctrine->getRepository(Permission::class)->countPermission();
        $partenaire = $doctrine->getRepository(Partenaire::class)->find($id);

        return $this->render('structure/partenaire-id.html.twig', [
            'title' => 'SDS- Votre Franchise',
            'partenaire' => $partenaire,
            'user' => $user,
            'structure' => $structure,
            'permission' => $permissions[0][1],
        ]);
    }


    #[Route('/partenaire/update/{id}', name: 'app_update_partenaire')]
    public function update(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger, int $id, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();


        $structure = $doctrine->getRepository(Structure::class)->findAll();
        $permissions = $doctrine->getRepository(Permission::class)->countPermission();
        $partenaire = $doctrine->getRepository(Partenaire::class)->find($id);

        $partenaireUpdate = $doctrine->getRepository(Partenaire::class)->find($id);

        $form = $this->createForm(PartenaireType::class, $partenaireUpdate);
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
                $partenaireUpdate->setLogoStructure($newFilename);
                $partenaireUpdate = $form->getData();
            }
            $entityManager->persist($partenaireUpdate);
            $entityManager->flush();
            return $this->redirectToRoute('app_partenaire');
        }
        return $this->render('update/update-partenaire.html.twig', [
            'form' => $form->createView(),
            'title' => 'SDS- Modification du partenaire',
            'partenaireUpdate' => $partenaireUpdate,
            'structure' => $structure,
            'permissions' => $permissions,
        ]);
    }







}
