<?php

namespace EliteFifa\AssociationBundle\Controller;

use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\AssociationBundle\Service\AssociationService;
use EliteFifa\CompetitionBundle\Service\CompetitionService;
use EliteFifa\SeasonBundle\Service\SeasonService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAssociationController extends Controller
{
    public function createAction(Request $request)
    {
        $association = new Association();

        $seasonId = $request->query->get('seasonId');
        if ($seasonId != null) {
            $seasonService = $this->getSeasonService();
            $season = $seasonService->getSeasonById($seasonId);
            if ($season == null) {
                throw new \Exception("Season not found");
            }
            $association->addSeason($season);
        }

        $form = $this->createFormBuilder($association)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $association = $form->getData();

            $associationService = $this->getAssociationService();
            $associationService->save($association);

            return $this->redirectToRoute('elite_fifa.admin_show_association', [
                'slug' => $association->getSlug()
            ]);
        }

        return $this->render('AssociationBundle:AdminAssociation:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return Response
     * @throws \Exception
     */
    public function showAction(Request $request, string $slug)
    {
        $associationService = $this->getAssociationService();
        $association = $associationService->getAssociationBySlug($slug);

        $seasonNumber = $request->query->get('season');
        if ($seasonNumber != null) {
            $seasonService = $this->getSeasonService();
            $season = $seasonService->getSeasonByNumber($seasonNumber);
        }

        $competitionService = $this->getCompetitionService();
        $competitions = $competitionService->getCompetitionsByAssociationAndSeason($association, $season);

        return $this->render('AssociationBundle:AdminAssociation:show.html.twig', [
            'association' => $association,
            'season' => $season,
            'competitions' => $competitions
        ]);
    }


    /**
     * @param Competition $competition
     * @param int $seasonNumber
     * @return Season
     */
    private function getSeason(Competition $competition, $seasonNumber)
    {
        $season = null;

        $seasonService = $this->getSeasonService();
        if ($seasonNumber != null) {
            $season = $seasonService->getSeasonByCompetitionAndNumber($competition, $seasonNumber);
        }

        if ($season == null) {
            $season = $seasonService->getLatestSeasonForCompetition($competition);
        }

        return $season;
    }

    public function listAction(Request $request)
    {
        $associationService = $this->getAssociationService();
        $associations = $associationService->getAllAssociations();

        return $this->render('AssociationBundle:AdminAssociation:list.html.twig', [
            'associations' => $associations
        ]);
    }

    /**
     * @return AssociationService
     */
    private function getAssociationService()
    {
        return $this->get('elite_fifa.association_service');
    }

    /**
     * @return SeasonService
     */
    private function getSeasonService()
    {
        return $this->get('elite_fifa.season_service');
    }

    /**
     * @return CompetitionService
     */
    private function getCompetitionService()
    {
        return $this->get('elite_fifa.competition_service');
    }
}