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
use App\Entity\Technologie;
use App\Form\TechnologieType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class TechnologieController extends AbstractController
{
    #[Route('/technologie', name: 'app_technologie')]
    public function index(): Response
    {
        return $this->render('technologie/index.html.twig', [
            'controller_name' => 'TechnologieController',
        ]);
    }


    #[Route('/technologie/ajouter', name: 'app_technologie_add')]
    public function addTechnologie(Request $request, EntityManagerInterface $entityManager): Response
    {
        $techno = new Technologie();
        $form = $this->createForm(TechnologieType::class, $techno);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($techno);
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion');
        }

        return $this->render('gestion/index.html.twig', [
            'form_technologie' => $form->createView(),
        ]);
    }

    #[Route('/technologie/{id}/modifier', name: 'app_technologie_edit')]
    public function editTechnologie(
        Technologie $techno,
        Request $request,
        EntityManagerInterface $entityManager,
        ProjetRepository $projetRepository,
        FormationRepository $formationRepository,
        ExperienceRepository $experienceRepository,
        TechnologieRepository $technologieRepository,
        CentreInteretRepository $centreInteretRepository
    ): Response
    {
        $form = $this->createForm(TechnologieType::class, $techno);

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
            'form_centreInteret' => $form->createView(),
            'form_experience' => $form->createView(),
            'form_technologie' => $form->createView(),
            'technologie' => $techno,
            'projets' => $projets,
            'formations' => $formations,
            'experiences' => $experiences,
            'technologies' => $technologies,
            'centresInterets' => $centresInterets,
        ]);
    }

    #[Route('/technologie/{id}/supprimer', name: 'app_technologie_delete')]
    public function deleteTechnologie(Technologie $techno, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($techno);
        $entityManager->flush();

        return $this->redirectToRoute('app_gestion');
    }

}
