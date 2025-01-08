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
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ExperienceType;
use App\Entity\Experience;


class ExperienceController extends AbstractController
{
    #[Route('/experience', name: 'app_experience')]
    public function index(): Response
    {
        return $this->render('experience/index.html.twig', [
            'controller_name' => 'ExperienceController',
        ]);
    }

    #[Route('/experience/ajouter', name: 'app_experience_add')]
    public function addExperience(Request $request, EntityManagerInterface $entityManager): Response
    {
        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($experience);
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion');
        }

        return $this->render('gestion/index.html.twig', [
            'form_experience' => $form->createView(),
        ]);
    }

    #[Route('/experience/{id}/modifier', name: 'app_experience_edit')]
    public function editExperience(
        Experience $experience,
        Request $request,
        EntityManagerInterface $entityManager,
        ProjetRepository $projetRepository,
        FormationRepository $formationRepository,
        ExperienceRepository $experienceRepository,
        TechnologieRepository $technologieRepository,
        CentreInteretRepository $centreInteretRepository
    ): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);

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
            'form_centreInteret' => $form->createView(),
            'form_experience' => $form->createView(),
            'experience' => $experience,
            'projets' => $projets,
            'formations' => $formations,
            'experiences' => $experiences,
            'technologies' => $technologies,
            'centresInterets' => $centresInterets,
        ]);
    }

    #[Route('/experience/{id}/supprimer', name: 'app_experience_delete')]
    public function deleteExperience(Experience $experience, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($experience);
        $entityManager->flush();

        return $this->redirectToRoute('app_gestion');
    }

    
}
