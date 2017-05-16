<?php

namespace EliteFifa\CompetitionBundle\Controller;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitionBundle\Service\CompetitionService;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\SeasonBundle\Service\SeasonService;
use EliteFifa\StandingBundle\Service\StandingService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CompetitionController extends Controller
{
    public function showAction(Request $request, $slug)
    {
        $competitionService = $this->getCompetitionService();
        $competition = $competitionService->getCompetitionBySlug($slug);

        $seasonNumber = $request->query->get('season');
        $season = $this->getSeason($competition, $seasonNumber);

        $matchService = $this->getMatchService();
        $matches = $matchService->getMatchesByCompetitionAndSeason($competition, $season);

        $standingService = $this->getStandingService();
        $standings = $standingService->getStandingsByMatches($matches);

        return $this->render('CompetitionBundle:Competition:show.html.twig', [
            'season' => $season,
            'competition' => $competition,
            'standings' => $standings
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

    /**
     * @return CompetitionService
     */
    private function getCompetitionService()
    {
        return $this->get('elite_fifa.competition_service');
    }

    /**
     * @return SeasonService
     */
    private function getSeasonService()
    {
        return $this->get('elite_fifa.season_service');
    }

    /**
     * @return StandingService
     */
    private function getStandingService()
    {
        return $this->get('elite_fifa.standing_service');
    }

    /**
     * @return MatchService
     */
    private function getMatchService()
    {
        return $this->get('elite_fifa.match_service');
    }
}