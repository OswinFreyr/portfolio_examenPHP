<?php 

namespace App\Controller;

use App\Entity\CentreInteret;
use App\Entity\Projet;
use App\Entity\Formation;
use App\Entity\Experience;
use App\Entity\Technologie;
use App\Form\CentreInteretType;
use App\Form\ProjetType;
use App\Form\FormationType;
use App\Form\ExperienceType;
use App\Form\TechnologieType;
use App\Repository\ProjetRepository;
use App\Repository\FormationRepository;
use App\Repository\ExperienceRepository;
use App\Repository\TechnologieRepository;
use App\Repository\CentreInteretRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class GestionController extends AbstractController
{
    #[Route('/gestion', name: 'app_gestion')]
    public function gestion(
        Request $request,
        EntityManagerInterface $entityManager,
        ProjetRepository $projetRepository,
        FormationRepository $formationRepository,
        ExperienceRepository $experienceRepository,
        TechnologieRepository $technologieRepository,
        CentreInteretRepository $centreInteretRepository
    ): Response {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // or add an optional message - seen by developers
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');


        $projet = new Projet();
        $formProjet = $this->createForm(ProjetType::class, $projet);
        $formProjet->handleRequest($request);

        if ($formProjet->isSubmitted() && $formProjet->isValid()) {
            $entityManager->persist($projet);
            $entityManager->flush();
            $this->addFlash('success', 'Projet ajouté avec succès.');
            return $this->redirectToRoute('app_gestion');
        }

        $formation = new Formation();
        $formFormation = $this->createForm(FormationType::class, $formation);
        $formFormation->handleRequest($request);

        if ($formFormation->isSubmitted() && $formFormation->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();
            $this->addFlash('success', 'Formation ajoutée avec succès.');
            return $this->redirectToRoute('app_gestion');
        }

        $experience = new Experience();
        $formExperience = $this->createForm(ExperienceType::class, $experience);
        $formExperience->handleRequest($request);

        if ($formExperience->isSubmitted() && $formExperience->isValid()) {
            $entityManager->persist($experience);
            $entityManager->flush();
            $this->addFlash('success', 'Expérience ajoutée avec succès.');
            return $this->redirectToRoute('app_gestion');
        }

        $technologie = new Technologie();
        $formTechnologie = $this->createForm(TechnologieType::class, $technologie);
        $formTechnologie->handleRequest($request);

        if ($formTechnologie->isSubmitted() && $formTechnologie->isValid()) {
            $entityManager->persist($technologie);
            $entityManager->flush();
            $this->addFlash('success', 'Technologie ajoutée avec succès.');
            return $this->redirectToRoute('app_gestion');
        }

        $centreInteret = new CentreInteret();
        $formCentreInteret = $this->createForm(CentreInteretType::class, $centreInteret);
        $formCentreInteret->handleRequest($request);

        if ($formCentreInteret->isSubmitted() && $formCentreInteret->isValid()) {
            $entityManager->persist($centreInteret);
            $entityManager->flush();
            $this->addFlash('success', 'Centre d’intérêt ajouté avec succès.');
            return $this->redirectToRoute('app_gestion');
        }

        $editProjetForm = null;
        $editFormationForm = null;

        $editProjetId = $request->query->get('edit_projet_id');
        if ($editProjetId) {
            $editProjet = $projetRepository->find($editProjetId);
            if ($editProjet) {
                $editProjetForm = $this->createForm(ProjetType::class, $editProjet);
                $editProjetForm->handleRequest($request);
        
                if ($editProjetForm->isSubmitted() && $editProjetForm->isValid()) {
                    $entityManager->flush();  
                    $this->addFlash('success', 'Projet modifié avec succès.');
                    return $this->redirectToRoute('app_gestion');
                }
            } else {
                throw $this->createNotFoundException('Projet non trouvé.');
            }
        }
        

        $editFormationId = $request->query->get('edit_formation_id');
        if ($editFormationId) {
            $editFormation = $formationRepository->find($editFormationId);

            if (!$editFormation) {
                $this->addFlash('error', 'Formation non trouvée.');
                return $this->redirectToRoute('app_gestion');
            }

            $editFormationForm = $this->createForm(FormationType::class, $editFormation);
            $editFormationForm->handleRequest($request);

            if ($editFormationForm->isSubmitted() && $editFormationForm->isValid()) {
                $entityManager->flush(); // Mise à jour uniquement
                $this->addFlash('success', 'Formation modifiée avec succès.');
                return $this->redirectToRoute('app_gestion');
            }
        }

        $projets = $projetRepository->findAll();
        $formations = $formationRepository->findAll();
        $experiences = $experienceRepository->findAll();
        $technologies = $technologieRepository->findAll();
        $centresInterets = $centreInteretRepository->findAll();

        return $this->render('gestion/index.html.twig', [
            'form_projet' => $formProjet->createView(),
            'form_formation' => $formFormation->createView(),
            'form_experience' => $formExperience->createView(),
            'form_technologie' => $formTechnologie->createView(),
            'form_centreInteret' => $formCentreInteret->createView(),
            'form_edit_projet' => $editProjetForm ? $editProjetForm->createView() : null,
            'form_edit_formation' => $editFormationForm ? $editFormationForm->createView() : null,
            'projets' => $projets,
            'formations' => $formations,
            'experiences' => $experiences,
            'technologies' => $technologies,
            'centresInterets' => $centresInterets,
            'edit_projet_id' => $editProjetId, 
        ]);
    }
}
