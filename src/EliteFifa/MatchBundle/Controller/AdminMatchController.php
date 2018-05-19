<?php

namespace EliteFifa\MatchBundle\Controller;

use EliteFifa\StandingBundle\Service\StandingService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\CompetitorBundle\Service\CompetitorService;

class AdminMatchController extends Controller
{
    /**
     * @param int $competitorId
     */
    public function simulateAction(int $competitorId)
    {
        $competitorService = $this->getCompetitorService();
        $competitor = $competitorService->getCompetitorById($competitorId);

        $homeMatches = $competitor->getHomeMatches();
        $awayMatches = $competitor->getAwayMatches();

        $matchService = $this->getMatchService();
        $haveAllHomeMatchesBeenConfirmed = $matchService->haveAllMatchesBeenConfirmed($homeMatches);
        $haveAllAwayMatchesBeenConfirmed = $matchService->haveAllMatchesBeenConfirmed($awayMatches);

        $standingService = $this->getStandingService();

        if (!$haveAllHomeMatchesBeenConfirmed) {
            foreach ($homeMatches as $match) {
                if (!$match->isConfirmed()) {
                    $matchService->simulateMatch($match, $competitor);
                    $standingService->updateStandingsByMatch($match);
                }
            }
        }

        if (!$haveAllAwayMatchesBeenConfirmed) {
            foreach ($awayMatches as $match) {
                if (!$match->isConfirmed()) {
                    $matchService->simulateMatch($match, $competitor);
                    $standingService->updateStandingsByMatch($match);
                }
            }
        }
    }

    /**
     * @return CompetitorService
     */
    private function getCompetitorService()
    {
        return $this->get("elite_fifa.competitor_service");
    }

    /**
     * @return MatchService
     */
    private function getMatchService()
    {
        return $this->get("elite_fifa.match_service");
    }

    /**
     * @return StandingService
     */
    private function getStandingService()
    {
        return $this->get("elite_fifa.standing_service");
    }
}