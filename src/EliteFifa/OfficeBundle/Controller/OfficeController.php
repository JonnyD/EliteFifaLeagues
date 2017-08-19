<?php

namespace EliteFifa\OfficeBundle\Controller;

use EliteFifa\BaseBundle\Controller\BaseController;
use EliteFifa\CareerBundle\Service\CareerService;
use EliteFifa\CompetitorBundle\Service\CompetitorService;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\SeasonBundle\Service\SeasonService;

class OfficeController extends BaseController
{
    public function showAction()
    {
        $user = $this->getLoggedInUser();

        $careerService = $this->getCareerService();
        $careers = $careerService->getCareersByUser($user);
        $career = $careers[0]; //TODO multiple careers

        $matchService = $this->getMatchService();
        $homeMatches = $matchService->getHomeMatchesByCompetitor($career->getCompetitor());
        $awayMatches = $matchService->getAwayMatchesByCompetitor($career->getCompetitor());

        return $this->render('OfficeBundle:Office:show.html.twig', [
            'homeMatches' => $homeMatches,
            'awayMatches' => $awayMatches
        ]);
    }

    /**
     * @return CareerService
     */
    private function getCareerService()
    {
        return $this->get('elite_fifa.career_service');
    }

    /**
     * @return SeasonService
     */
    private function getSeasonService()
    {
        return $this->get('elite_fifa.season_service');
    }

    /**
     * @return CompetitorService
     */
    private function getCompetitorService()
    {
        return $this->get('elite_fifa.competitor_service');
    }

    /**
     * @return MatchService
     */
    private function getMatchService()
    {
        return $this->get('elite_fifa.match_service');
    }
}