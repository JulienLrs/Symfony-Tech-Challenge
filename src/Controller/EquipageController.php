<?php

namespace App\Controller;

use App\Entity\Equipage;
use App\Form\EquipageType;
use App\Repository\EquipageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EquipageController extends AbstractController
{
    #[Route('/', name: 'app_equipage')]
    public function index(Request $request, ManagerRegistry $doctrine, EquipageRepository $equipageRepository): Response
    {
        // Instanciation des données du formulaire, avec un objet vide
        $equipage = new Equipage();
        $form = $this->createForm(EquipageType::class, $equipage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em -> persist($equipage);
            $em -> flush();
            $this->addFlash('success', 'Bienvenue à bord Matelot !');
            return $this->redirectToRoute('app_equipage');
        }
        // récupération des données du formulaire
        return $this->render('equipage/index.html.twig', [
            'equipages' => $equipageRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
