<?php

namespace EliteFifa\MatchBundle\Controller;

use EliteFifa\CompetitionBundle\Service\LeagueService;
use EliteFifa\SeasonBundle\Service\SeasonService;
use EliteFifa\StandingBundle\Service\StandingService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\UserBundle\Service\UserService;

class MatchController extends Controller
{
    public function showAction($id)
    {
        $match = $this->getMatch($id);

        return $this->render('MatchBundle:Match:show.html.twig', [
            'match' => $match
        ]);
    }

    public function reportAction(Request $request, $id)
    {
        $match = $this->getMatch($id);

        $userService = $this->getUserService();
        $loggedInUser = $userService->getLoggedInUser();

        $homeUser = $match->getHomeTeam()->getUser();
        if ($loggedInUser != $homeUser) {
            throw $this->createNotFoundException('Only home team can report match');
        }

        $form = $this->createForm('report_match', $match);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $match->setReportedToNow();

            $matchService = $this->getMatchService();
            $matchService->persist($match);

            return $this->redirect($this->generateUrl('elite_fifa.show_office'));
        }

        return $this->render('EliteFifaBundle:Match:report.html.twig', [
            'match' => $match,
            'form' => $form->createView()
        ]);
    }

    public function reportLadderAction(Request $request)
    {
        $match = new Match();
        $form = $this->createForm('report_ladder_match', $match);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $match->setReportedToNow();

            $leagueManager = $this->getLeagueService();
            $league = $leagueManager->getLeagueByName("EFL Ladder");
            $match->setLeague($league);

            $seasonService = $this->getSeasonService();
            $season = $seasonService->getCurrentSeasonForLeague($league);
            $match->setSeason($season);

            $matchService = $this->getMatchService();
            $matchService->persist($match);
        }

        return $this->render('EliteFifaBundle:Match:reportLadder.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function confirmAction(Request $request, $id)
    {
        $match = $this->getMatch($id);

        $userService = $this->getUserService();
        $loggedInUser = $userService->getLoggedInUser();

        $awayUser = $match->getAwayTeam()->getUser();
        if ($loggedInUser != $awayUser) {
            throw $this->createNotFoundException('Only away team can confirm match');
        }

        $form = $this->createForm('confirm_match', $match);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $matchService = $this->getMatchService();
            $matchService->confirm($match);

            $standingService = $this->getStandingService();
            $standingService->updateStandingsByMatch($match);
            $standingService->updateRankingsByMatch($match);

            return $this->redirect($this->generateUrl('elite_fifa.show_office'));
        }

        return $this->render('EliteFifaBundle:Match:confirm.html.twig', [
            'match' => $match,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param int $id
     * @return Match
     */
    private function getMatch(int $id)
    {
        $matchService = $this->getMatchService();
        $match = $matchService->getMatchById($id);
        if (!$match) {
            throw $this->createNotFoundException('Unable to find match');
        }
        return $match;
    }

    public function listAction()
    {
        $matchService = $this->getMatchService();
        $matches = $matchService->getAllMatches();

        return $this->render('EliteFifaBundle:Match:list.html.twig', [
            'matches' => $matches,
        ]);
    }

    /**
     * @return MatchService
     */
    private function getMatchService()
    {
        return $this->get('elite_fifa.match_service');
    }

    /**
     * @return UserService
     */
    private function getUserService()
    {
        return $this->get('elite_fifa.user_service');
    }

    /**
     * @return SeasonService
     */
    private function getSeasonService()
    {
        return $this->get('elite_fifa.season_service');
    }

    /**
     * @return LeagueService
     */
    private function getLeagueService()
    {
        return $this->get('elite_fifa.league_service');
    }

    /**
     * @return StandingService
     */
    private function getStandingService()
    {
        return $this->get('elite_fifa.standing_service');
    }
}