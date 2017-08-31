<?php

namespace EliteFifa\BaseBundle\Controller;

use EliteFifa\Bundle\Form\SelectSeasonForm;
use EliteFifa\CompetitionBundle\Service\CompetitionService;
use EliteFifa\CompetitorBundle\Service\CompetitorService;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\SeasonBundle\Service\SeasonService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function showAction()
    {
        /** @var CompetitorService $competitorService */
        $competitorService = $this->get('elite_fifa.competitor_service');
        /** @var MatchService $matchService */
        $matchService = $this->get('elite_fifa.match_service');
        /** @var CompetitionService $competitionService */
        $competitionService = $this->get('elite_fifa.competition_service');
        /** @var SeasonService $seasonService */
        $seasonService = $this->get('elite_fifa.season_service');
        $season = $seasonService->getLatestSeason();

        $competition = $competitionService->getCompetitionBySlug('elite-league-1');
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($competition, $season);

        $matches = $matchService->createFixtures($competitors, $competition, $season);

        return $this->render('BaseBundle:Default:index.html.twig', array(

        ));
    }
}