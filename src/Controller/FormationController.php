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
use App\Form\FormationType;
use App\Entity\Formation;

class FormationController extends AbstractController
{
    #[Route('/formation', name: 'app_formation')]
    public function index(): Response
    {
        return $this->render('formation/index.html.twig', [
            'controller_name' => 'FormationController',
        ]);
    }


    #[Route('/formation/ajouter', name: 'app_formation_add')]
    public function addFormation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('app_gestion');
        }

        return $this->render('gestion/index.html.twig', [
            'form_formation' => $form->createView(),
        ]);
    }

    #[Route('/formation/{id}/modifier', name: 'app_formation_edit')]
    public function editFormation(
        Formation $formation,
        Request $request,
        EntityManagerInterface $entityManager,
        ProjetRepository $projetRepository,
        FormationRepository $formationRepository,
        ExperienceRepository $experienceRepository,
        TechnologieRepository $technologieRepository,
        CentreInteretRepository $centreInteretRepository,
        int $id
    ): Response
    {
        $form = $this->createForm(FormationType::class, $formation);

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
        $edit_formation_id = $id;

        return $this->render('gestion/index.html.twig', [
            'form_projet' => $form->createView(),
            'form_technologie' => $form->createView(),
            'form_centreInteret' => $form->createView(),
            'form_experience' => $form->createView(),
            'form_formation' => $form->createView(),
            'formation' => $formation,
            'projets' => $projets,
            'formations' => $formations,
            'experiences' => $experiences,
            'technologies' => $technologies,
            'centresInterets' => $centresInterets,
            'edit_formation_id' => $edit_formation_id,
        ]);
    }

    #[Route('/formation/{id}/supprimer', name: 'app_formation_delete')]
    public function deleteFormation(Formation $formation, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($formation);
        $entityManager->flush();

        return $this->redirectToRoute('app_gestion');
    }
}
