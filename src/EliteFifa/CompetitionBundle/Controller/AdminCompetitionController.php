<?php

namespace EliteFifa\CompetitionBundle\Controller;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitionBundle\Enum\CompetitionType;
use EliteFifa\CompetitionBundle\Service\CompetitionService;
use EliteFifa\CompetitorBundle\Service\CompetitorService;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\SeasonBundle\Service\SeasonService;
use EliteFifa\StandingBundle\Service\StandingService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCompetitionController extends Controller
{
    /**
     * @param Request $request
     * @param string $slug
     * @return Response
     */
    public function showAction(Request $request, string $slug)
    {
        $competitionService = $this->getCompetitionService();
        $competition = $competitionService->getCompetitionBySlug($slug);

        $seasonNumber = $request->query->get('season');
        $season = $this->getSeason($competition, $seasonNumber);

        $matchService = $this->getMatchService();
        $matches = $matchService->getMatchesByCompetitionAndSeason($competition, $season);

        $standingService = $this->getStandingService();
        $overallStandings = $standingService->getOverallStandingsByCompetitionAndSeason($competition, $season);
        $homeStandings = $standingService->getHomeStandingsByCompetitionAndSeason($competition, $season);
        $awayStandings = $standingService->getAwayStandingsByCompetitionAndSeason($competition, $season);

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($competition, $season);

        return $this->render('CompetitionBundle:AdminCompetition:show.html.twig', [
            'competition' => $competition,
            'season' => $season,
            'matches' => $matches,
            'overallStandings' => $overallStandings,
            'homeStandings' => $homeStandings,
            'awayStandings' => $awayStandings,
            'competitors' => $competitors
        ]);
    }

    public function createAction(Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('competitionType', ChoiceType::class, [
                'choices'  => [
                    'league' => 'league',
                    'knockout' => 'knockout',
                    'multi-stage' => 'multi-stage',
                    ]
                ]
            )
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $competitionType = $data['competitionType'];

            switch ($competitionType) {
                case CompetitionType::LEAGUE:
                    return $this->redirectToRoute('elite_fifa.admin_create_league', [
                        'slug' => $association->getSlug()
                    ]);
            }
        }

        return $this->render('CompetitionBundle:AdminCompetition:create.html.twig', [
            'form' => $form->createView()
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
     * @return MatchService
     */
    private function getMatchService()
    {
        return $this->get('elite_fifa.match_service');
    }

    /**
     * @return StandingService
     */
    private function getStandingService()
    {
        return $this->get('elite_fifa.standing_service');
    }

    /**
     * @return CompetitorService
     */
    private function getCompetitorService()
    {
        return $this->get('elite_fifa.competitor_service');
    }
}