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

class StructurePartenaireController extends AbstractController
{
    #[Route('/login-partenaire/structure/{id}', name: 'app_structure_partenaire')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $structure = $doctrine->getRepository(Structure::class)->find($id);
        $permission = $doctrine->getRepository(Permission::class)->findAll();

        return $this->render('structure/structure-partenaire.html.twig', [
            'title' => 'Dantabase - Structure de l\'entreprise',
            'structure' => $structure,
            'permissions' => $permission,
            ]);
    }
}
