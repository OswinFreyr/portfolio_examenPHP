<?php

namespace App\Controller;

use App\Repository\CentreInteretRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FormationRepository;
use App\Repository\ProjetRepository;
use App\Repository\TechnologieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\CentreInteretType;
use App\Entity\CentreInteret;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class CentreInteretController extends AbstractController
{
    #[Route('/centre/interet', name: 'app_centre_interet')]
    public function index(): Response
    {
        return $this->render('centre_interet/index.html.twig', [
            'controller_name' => 'CentreInteretController',
        ]);
    }


    #[Route('/centreInteret/ajouter', name: 'app_centreInteret_add')]
    public function addCentreInteret(Request $request, EntityManagerInterface $entityManager): Response
    {
        $centreInteret = new CentreInteret();
        $form = $this->createForm(CentreInteretType::class, $centreInteret);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($centreInteret);
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion');
        }

        return $this->render('gestion/index.html.twig', [
            'form_centreInteret' => $form->createView(),
        ]);
    }

    #[Route('/centreInteret/{id}/modifier', name: 'app_centreInteret_edit')]
    public function editCentreInteret(
        CentreInteret $centreInteret,
        Request $request,
        EntityManagerInterface $entityManager,
        ProjetRepository $projetRepository,
        FormationRepository $formationRepository,
        ExperienceRepository $experienceRepository,
        TechnologieRepository $technologieRepository,
        CentreInteretRepository $centreInteretRepository
    ): Response
    {
        $form = $this->createForm(CentreInteretType::class, $centreInteret);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion');
        }

        $projets = $projetRepository->findAll();
        $formations = $formationRepository->findAll();
        $experiences = $experienceRepository->findAll();
        $technologies = $technologieRepository->findAll();
        $centresInterets = $centreInteretRepository->findAll();

        return $this->render('gestion/index.html.twig', [
            'form_projet' => $form->createView(),
            'form_formation' => $form->createView(),
            'form_technologie' => $form->createView(),
            'form_experience' => $form->createView(),
            'form_centreInteret' => $form->createView(),
            'centreInteret' => $centreInteret,
            'projets' => $projets,
            'formations' => $formations,
            'experiences' => $experiences,
            'technologies' => $technologies,
            'centresInterets' => $centresInterets
        ]);
    }

    #[Route('/centreInteret/{id}/supprimer', name: 'app_centreInteret_delete')]
    public function deleteCentreInteret(CentreInteret $centreInteret, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($centreInteret);
        $entityManager->flush();

        return $this->redirectToRoute('app_gestion');
    }

}
