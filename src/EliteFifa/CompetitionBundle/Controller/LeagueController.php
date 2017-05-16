<?php

namespace EliteFifa\CompetitionBundle\Controller;

use EliteFifa\SeasonBundle\Form\SelectSeasonForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

//todo
class LeagueController extends Controller
{
    public function showOverviewAction(Request $request, $slug)
    {
        $leagueManager = $this->get('elite_fifa.competition_manager');
        $league = $leagueManager->getLeagueBySlug($slug);

        $seasonManager = $this->get('elite_fifa.season_manager');
        $seasonNumber = $request->query->get('season');
        $selectedSeason = $seasonManager->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

        $table = $request->query->get("table");
        if ($table == null) {
            $table = "overall";
        }
        $standings = $leagueManager->getStandingsByLeagueAndSeason($league, $selectedSeason, $table);
        //$leagueManager->assignCurrentPositionByStandings($standings);

        $showLeagueLink = $this->generateUrl('elite_fifa.show_league', array('slug' => $slug));
        $selectSeasonForm = $seasonManager->createSelectSeasonDropDown($league, $showLeagueLink, $selectedSeason);

        return $this->render('EliteFifaBundle:League:overview.html.twig', array(
            'season' => $selectedSeason,
            'league' => $league,
            'table' => $table,
            'standings' => $standings,
            'selectSeasonForm' => $selectSeasonForm->createView()
        ));
    }

    public function showMatchesAction(Request $request, $slug)
    {
        $leagueManager = $this->get('elite_fifa.competition_manager');
        $league = $leagueManager->getLeagueBySlug($slug);

        $seasonManager = $this->get('elite_fifa.season_manager');
        $seasonNumber = $request->query->get('season');
        $selectedSeason = $seasonManager->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

        $showLeagueLink = $this->generateUrl('elite_fifa.show_league', array('slug' => $slug));

        $matchManager = $this->get("elite_fifa.match_manager");
        $roundNumber = $request->query->get("round");
        $selectedRound = $matchManager->getSelectedRound($roundNumber);
        $selectRoundForm = $matchManager->createSelectRoundDropDown($league, $selectedSeason, $roundNumber, $showLeagueLink);

        $matches = $matchManager->getMatchesForCompetitionBySeasonAndRound($league, $selectedSeason, $selectedRound);

        return $this->render('EliteFifaBundle:League:matches.html.twig', array(
            'season' => $selectedSeason,
            'league' => $league,
            'selectRoundForm' => $selectRoundForm->createView(),
            'matches' => $matches
        ));
    }

    public function showStatsAction(Request $request, $slug)
    {
        $leagueManager = $this->get('elite_fifa.competition_manager');
        $league = $leagueManager->getLeagueBySlug($slug);

        $seasonManager = $this->get('elite_fifa.season_manager');
        $seasonNumber = $request->query->get('season');
        $season = $seasonManager->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

        $statsManager = $this->get("elite_fifa.stats_manager");
        $teamsPlayed = $statsManager->getTeamsByPlayed($league, $season);
        $teamsWon = $statsManager->getTeamsByWon($league, $season);
        $teamsDrawn = $statsManager->getTeamsByDrawn($league, $season);
        $teamsLost = $statsManager->getTeamsByLost($league, $season);
        $teamsForm = $statsManager->getTeamsByCombinedForm($league, $season);
        $teamsHomeForm = $statsManager->getTeamsByHomeForm($league, $season);
        $teamsAwayForm = $statsManager->getTeamsByAwayForm($league, $season);
        $teamsByCurrentWinStreak = $statsManager->getTeamsByCurrentWinStreak($league, $season);
        $teamsByCurrentDrawStreak = $statsManager->getTeamsByCurrentDrawStreak($league, $season);
        $teamsByCurrentLossStreak = $statsManager->getTeamsByCurrentLossStreak($league, $season);
        $teamsByCurrentWithoutConcedingStreak = $statsManager->getTeamsByCurrentWithoutConcedingStreak($league, $season);
        $teamsByCurrentWithoutScoringStreak = $statsManager->getTeamsByCurrentWithoutScoringStreak($league, $season);
        $teamsByCurrentScoredStreak = $statsManager->getTeamsByCurrentScoredStreak($league, $season);
        $teamsWithoutWinning = $statsManager->getTeamsByCurrentWithoutWinningStreak($league, $season);
        $teamsWithoutLosing = $statsManager->getTeamsByCurrentWithoutLosingStreak($league, $season);
        $teamsScored = $statsManager->getTeamsByScored($league, $season);
        $teamsConceded = $statsManager->getTeamsByConceded($league, $season);
        $teamsYellow = $statsManager->getTeamsByYellows($league, $season);
        $teamsRed = $statsManager->getTeamsByReds($league, $season);

        return $this->render('EliteFifaBundle:League:stats.html.twig', array(
            'season' => $season,
            'league' => $league,
            'teamsPlayed' => $teamsPlayed,
            'teamsWon' => $teamsWon,
            'teamsDrawn' => $teamsDrawn,
            'teamsLost' => $teamsLost,
            'teamsForm' => $teamsForm,
            'teamsHomeForm' => $teamsHomeForm,
            'teamsAwayForm' => $teamsAwayForm,
            'teamsByCurrentWinStreak' => $teamsByCurrentWinStreak,
            'teamsByCurrentDrawStreak' => $teamsByCurrentDrawStreak,
            'teamsByCurrentLossStreak' => $teamsByCurrentLossStreak,
            'teamsByCurrentWithoutConcedingStreak' => $teamsByCurrentWithoutConcedingStreak,
            'teamsByCurrentWithoutScoringStreak' => $teamsByCurrentWithoutScoringStreak,
            'teamsByCurrentScoredStreak' => $teamsByCurrentScoredStreak,
            'teamsWithoutWinning' => $teamsWithoutWinning,
            'teamsWithoutLosing' => $teamsWithoutLosing,
            'teamsScored' => $teamsScored,
            'teamsConceded' => $teamsConceded,
            'teamsReds' => $teamsRed,
            'teamsYellows' => $teamsYellow
        ));
    }

    public function showHistoryAction(Request $request, $slug)
    {
        $leagueManager = $this->get('elite_fifa.competition_manager');
        $league = $leagueManager->getLeagueBySlug($slug);

        $statsManager = $this->get("elite_fifa.stats_manager");

        $seasonManager = $this->get('elite_fifa.season_manager');
        $seasonNumber = $request->query->get('season');
        if ($seasonNumber == "all") {
            $biggestWin = $statsManager->getBiggestWinByCompetition($league);
        } else {
            $season = $seasonManager->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

            $biggestWin = $statsManager->getBiggestWinByCompetitionAndSeason($league, $season);
            $highestScoringMatch = $statsManager->getHighestScoringMatchByCompetitionAndSeason($league, $season);
            $highestWithoutWinningStreak = $statsManager->getTeamWithHighestWithoutWinningStreak($league, $season);
            $highestWithoutLosingStreak = $statsManager->getTeamWithHighestWithoutLosingStreak($league, $season);
            $highestWithoutScoringStreak = $statsManager->getTeamWithHighestWithoutScoringStreak($league, $season);
            $highestScoredStreak = $statsManager->getTeamWithHighestScoredStreak($league, $season);
            $mostPoints = $statsManager->getTeamWithMostPoints($league, $season);
            $mostWins = $statsManager->getTeamWithMostWins($league, $season);
            $mostDraws = $statsManager->getTeamWithMostDraws($league, $season);
            $mostLosses = $statsManager->getTeamWithMostLosses($league, $season);
        }

        return $this->render('EliteFifaBundle:League:history.html.twig', array(
            'league' => $league,
            'season' => $season,
            'teamWithBiggestWin' => $biggestWin,
            'highestScoringMatch' => $highestScoringMatch,
            'highestWithoutWinningStreak' => $highestWithoutWinningStreak,
            'highestWithoutLosingStreak' => $highestWithoutLosingStreak,
            'highestWithoutScoringStreak' => $highestWithoutScoringStreak,
            'highestScoredStreak' => $highestScoredStreak,
            'mostPoints' => $mostPoints,
            'mostWins' => $mostWins,
            'mostDraws' => $mostDraws,
            'mostLosses' => $mostLosses
        ));
    }

    public function showAwardsAction(Request $request, $slug)
    {
        $leagueManager = $this->get('elite_fifa.competition_manager');
        $league = $leagueManager->getLeagueBySlug($slug);

        $seasonManager = $this->get('elite_fifa.season_manager');
        $seasonNumber = $request->query->get('season');
        $season = $seasonManager->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

        return $this->render('EliteFifaBundle:League:awards.html.twig', array(
            'league' => $league,
            'season' => $season
        ));
    }

    public function showLadderAction()
    {
        $leagueManager = $this->get('elite_fifa.competition_manager');
        $league = $leagueManager->getLeagueByName("Ladder");

        $seasonManager = $this->get('elite_fifa.season_manager');
        $currentSeason = $seasonManager->getCurrentSeasonForLeague($league);
        if ($currentSeason == null) {
            $currentSeason = $seasonManager->createSeasonForLadder($league);
        }

        $standings = $leagueManager->getUserStandingsByLeagueAndSeason($league, $currentSeason);

        return $this->render('EliteFifaBundle:League:ladder.html.twig', array(
            'league' => $league,
            'standings' => $standings,
            'season' => $currentSeason
        ));
    }

    public function showFifaKingAction()
    {
        return $this->render('EliteFifaBundle:Competition:fifaKing.html.twig', array(

        ));
    }
}