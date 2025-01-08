<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use App\Repository\FormationRepository;
use App\Repository\ExperienceRepository;
use App\Repository\CentreInteretRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function accueil(
        ProjetRepository $projetRepository, 
        FormationRepository $formationRepository, 
        ExperienceRepository $experienceRepository, 
        CentreInteretRepository $centreInteretRepository
    )
    {
        $projets = $projetRepository->createQueryBuilder('p')
            ->leftJoin('p.technologies', 't') 
            ->addSelect('t') 
            ->getQuery()
            ->getResult();

        // Récupérer les autres données (formations, expériences, centres d'intérêt)
        $formations = $formationRepository->findAll();
        $experiences = $experienceRepository->findAll();
        $centresInterets = $centreInteretRepository->findAll();

        // Passer les données aux templates
        return $this->render('accueil/index.html.twig', [
            'projets' => $projets,
            'formations' => $formations,
            'experiences' => $experiences,
            'centresInterets' => $centresInterets,
        ]);
    }
}
