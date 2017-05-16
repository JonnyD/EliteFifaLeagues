<?php

namespace EliteFifa\CompetitionBundle\Controller;

use EliteFifa\CompetitionBundle\Entity\ResultsTable;
use EliteFifa\MatchBundle\Form\SelectRoundForm;
use EliteFifa\CompetitionBundle\Service\CompetitionService;
use EliteFifa\CompetitionBundle\Service\StatsService;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\MatchBundle\Service\RoundService;
use EliteFifa\SeasonBundle\Form\SelectSeasonForm;
use EliteFifa\SeasonBundle\Service\SeasonService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OldCompetitionController extends Controller
{
    //TODO REFACTOR - TOO MUCH GOING ON
    public function showAction(Request $request, $slug)
    {
        $competitionService = $this->getCompetitionService();
        $competition = $competitionService->getCompetitionBySlug($slug);

        $requestedSeason = $request->query->get('season');
        $season = $competition->getSeason($requestedSeason);

        $matchService = $this->getMatchService();
        $matches = $matchService->getMatchesByCompetitionAndSeason($competition, $season);
        $resultsTable = new ResultsTable($matches);

        $totalMatches = $matchService->getAmountOfMatchesByCompetitionAndSeason($competition, $season);
        $playedMatches = $matchService->getAmountOfMatchesPlayedByCompetitionAndSeason($competition, $season);
        $percentageCompleted = $playedMatches * ($totalMatches / 100);
        $homeWins = $matchService->getAmountOfHomeWinsByCompetitionAndSeason($competition, $season);
        $awayWins = $matchService->getAmountOfAwayWinsByCompetitionAndSeason($competition, $season);
        $draws = $matchService->getAmountOfDrawsByCompetitionAndSeason($competition, $season);
        $goals = $matchService->getAmountOfGoalsByCompetitionAndSeason($competition, $season);
        $averageGoalsPerMatch = $matchService->getAverageGoalsPerMatchByCompetitionAndSeason($competition, $season);
        $bothTeamsScored = $matchService->getAmountBothTeamsScoredByCompetitionAndSeason($competition, $season);

        $positions = array();
        foreach ($resultsTable->getTeams() as $team) {
            $position = $competitionService->getPositionsForTeamByCompetitionAndSeason($team, $competition, $season);
            $positions[$team->getSlug()] = $position;
        }

        $standings = $competitionService->getStandingsByCompetitionAndSeason($competition, $season);
        $homeStandings = $competitionService->getHomeStandingsByCompetitionAndSeason($competition, $season);
        $awayStandings = $competitionService->getAwayStandingsByCompetitionAndSeason($competition, $season);

        $formStandingsLast6 = $competitionService->getFormStandingsByCompetitionAndSeason($competition, $season, 6);
        $formStandingsLast10 = $competitionService->getFormStandingsByCompetitionAndSeason($competition, $season, 10);
        $homeFormStandingsLast4 = $competitionService->getHomeFormStandingsByCompetitionAndSeason($competition, $season, 4);
        $homeFormStandingsLast8 = $competitionService->getHomeFormStandingsByCompetitionAndSeason($competition, $season, 8);
        $awayFormStandingsLast4 = $competitionService->getAwayFormStandingsByCompetitionAndSeason($competition, $season, 4);
        $awayFormStandingsLast8 = $competitionService->getAwayFormStandingsByCompetitionAndSeason($competition, $season, 8);

        $sequences = array();
        $participantManager = $this->get('elite_fifa.participant_manager');
        $participants = $participantManager->getParticipantsByCompetitionAndSeason($competition, $season);
        foreach ($participants as $participant) {
            $team = $participant->getTeam();
            $user = $team->getUser();
            $matches = $matchService->getConfirmedMatchesByTeamCompetitionSeasonOrderedByConfirmedDesc($team, $competition, $season);
            $won = 0;
            $drawn = 0;
            $lost = 0;
            $woWin = 0;
            $woDraw = 0;
            $woLoss = 0;
            $previous = null;

            foreach ($matches as $match) {
                $result = $match->getResult($user);
                if ($previous != null
                    && $previous != $result) {
                    break;
                }
                if ($result == "Win") {
                    $won++;
                } else if ($result == "Draw") {
                    $drawn++;
                } else if ($result == "Loss") {
                    $lost++;
                }
                $previous = $result;
            }

            $previous = null;
            foreach ($matches as $match) {
                $result = $match->getResult($user);
                if ($previous != null
                    && $previous != $result) {
                    break;
                }
                if ($result == "Win") {
                    $woDraw++;
                    $woLoss++;
                } else if ($result == "Draw") {
                    $woWin++;
                    $woLoss++;
                } else if ($result == "Loss") {
                    $woWin++;
                    $woDraw++;
                }
                $previous = $result;
            }

            $sequence = array();
            $sequence["team"] = $team->getName();
            $sequence["won"] = $won;
            $sequence["drawn"] = $drawn;
            $sequence["lost"] = $lost;
            $sequence["woWin"] = $woWin;
            $sequence["woDraw"] = $woDraw;
            $sequence["woLoss"] = $woLoss;

            $sequences[] = $sequence;
        }

        return $this->render('CompetitionBundle:Competition:show.html.twig', [
            'competition' => $competition,
            'standings' => $standings,
            'homeStandings' => $homeStandings,
            'awayStandings' => $awayStandings,
            'resultsTable' => $resultsTable,
            'positions' => $positions,
            'playedMatches' => $playedMatches,
            'totalMatches' => $totalMatches,
            'percentageComplete' => $percentageCompleted,
            'homeWins' => $homeWins,
            'awayWins' => $awayWins,
            'draws' => $draws,
            'goalsScored' => $goals,
            'averageGoalsPerMatch' => $averageGoalsPerMatch,
            'bothTeamsScored' => $bothTeamsScored,
            'formStandingsLast6' => $formStandingsLast6,
            'formStandingsLast10' => $formStandingsLast10,
            'homeFormStandingsLast4' => $homeFormStandingsLast4,
            'homeFormStandingsLast8' => $homeFormStandingsLast8,
            'awayFormStandingsLast4' => $awayFormStandingsLast4,
            'awayFormStandingsLast8' => $awayFormStandingsLast8,
            'sequences' => $sequences
        ]);
    }

    public function showOverviewAction(Request $request, $slug)
    {
        $competitionService = $this->getCompetitionService();
        $league = $competitionService->getCompetitionBySlug($slug);

        // todo refactor to temporal pattern
        $seasonService = $this->getSeasonService();
        $seasonNumber = $request->query->get('season');
        $selectedSeason = $seasonService->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

        $table = $request->query->get("table");
        if ($table == null) {
            $table = "overall";
        }

        if ($table === "home") {
            $standings = $competitionService->getHomeStandingsByCompetitionAndSeason($league, $selectedSeason);
        } else if ($table === "away") {
            $standings = $competitionService->getAwayStandingsByCompetitionAndSeason($league, $selectedSeason);
        } else {
            $standings = $competitionService->getStandingsByCompetitionAndSeason($league, $selectedSeason);
        }

        //$competitionService->assignCurrentPositionByStandings($standings);

        $showLeagueLink = $this->generateUrl('elite_fifa.show_league', array('slug' => $slug));
        $selectSeasonForm = $seasonService->createSelectSeasonDropDown($league, $showLeagueLink, $selectedSeason);

        $roundService = $this->getRoundService();
        $rounds = $roundService->getRoundsByCompetitionAndSeason($league, $selectedSeason);

        $roundNumber = $request->query->get("roundNumber");
        $selectRoundForm = new SelectRoundForm($rounds, $roundNumber);
        $selectRoundForm = $this->createForm($selectRoundForm);

        $matchService = $this->getMatchService();
        $matches = $matchService->getMatchesForCompetitionBySeasonAndRound($league, $selectedSeason, $roundNumber);

        return $this->render('CompetitionBundle:League:overview.html.twig', [
            'season' => $selectedSeason,
            'league' => $league,
            'table' => $table,
            'standings' => $standings,
            'selectSeasonForm' => $selectSeasonForm->createView(),
            'selectRoundForm' => $selectRoundForm->createView(),
            'matches' => $matches
        ]);
    }

    public function showMatchesAction(Request $request, $slug)
    {
        $competitionService = $this->getCompetitionService();
        $league = $competitionService->geteCompetitionBySlug($slug);

        $seasonService = $this->getSeasonService();
        $seasonNumber = $request->query->get('season');
        $selectedSeason = $seasonService->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

        $showLeagueLink = $this->generateUrl('elite_fifa.show_league', array('slug' => $slug));

        $matchService = $this->getMatchService();
        $roundNumber = $request->query->get("round");
        $selectedRound = $matchService->getSelectedRound($roundNumber);
        $selectRoundForm = $matchService->createSelectRoundDropDown($league, $selectedSeason, $roundNumber, $showLeagueLink);

        $matches = $matchService->getMatchesForCompetitionBySeasonAndRound($league, $selectedSeason, $selectedRound);

        return $this->render('CompetitionBundle:League:matches.html.twig', [
            'season' => $selectedSeason,
            'league' => $league,
            'selectRoundForm' => $selectRoundForm->createView(),
            'matches' => $matches
        ]);
    }

    public function showStatsAction(Request $request, $slug)
    {
        $competitionService = $this->getCompetitionService();
        $league = $competitionService->getLeagueBySlug($slug);

        $seasonService = $this->getSeasonService();
        $seasonNumber = $request->query->get('season');
        $season = $seasonService->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

        $statsService = $this->getStatsService();
        $teamsPlayed = $statsService->getTeamsByPlayed($league, $season);
        $teamsWon = $statsService->getTeamsByWon($league, $season);
        $teamsDrawn = $statsService->getTeamsByDrawn($league, $season);
        $teamsLost = $statsService->getTeamsByLost($league, $season);
        $teamsForm = $statsService->getTeamsByCombinedForm($league, $season);
        $teamsHomeForm = $statsService->getTeamsByHomeForm($league, $season);
        $teamsAwayForm = $statsService->getTeamsByAwayForm($league, $season);
        $teamsByCurrentWinStreak = $statsService->getTeamsByCurrentWinStreak($league, $season);
        $teamsByCurrentDrawStreak = $statsService->getTeamsByCurrentDrawStreak($league, $season);
        $teamsByCurrentLossStreak = $statsService->getTeamsByCurrentLossStreak($league, $season);
        $teamsByCurrentWithoutConcedingStreak = $statsService->getTeamsByCurrentWithoutConcedingStreak($league, $season);
        $teamsByCurrentWithoutScoringStreak = $statsService->getTeamsByCurrentWithoutScoringStreak($league, $season);
        $teamsByCurrentScoredStreak = $statsService->getTeamsByCurrentScoredStreak($league, $season);
        $teamsWithoutWinning = $statsService->getTeamsByCurrentWithoutWinningStreak($league, $season);
        $teamsWithoutLosing = $statsService->getTeamsByCurrentWithoutLosingStreak($league, $season);
        $teamsScored = $statsService->getTeamsByScored($league, $season);
        $teamsConceded = $statsService->getTeamsByConceded($league, $season);
        $teamsYellow = $statsService->getTeamsByYellows($league, $season);
        $teamsRed = $statsService->getTeamsByReds($league, $season);

        return $this->render('CompetitionBundle:League:stats.html.twig', [
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
        ]);
    }

    public function showHistoryAction(Request $request, $slug)
    {
        $competitionService = $this->getCompetitionService();
        $league = $competitionService->getLeagueBySlug($slug);

        $statsService = $this->getStatsService();

        $seasonService = $this->getSeasonService();
        $seasonNumber = $request->query->get('season');
        if ($seasonNumber == "all") {
            $biggestWin = $statsService->getBiggestWinByCompetition($league);
        } else {
            $season = $seasonService->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

            $biggestWin = $statsService->getBiggestWinByCompetitionAndSeason($league, $season);
            $highestScoringMatch = $statsService->getHighestScoringMatchByCompetitionAndSeason($league, $season);
            $highestWithoutWinningStreak = $statsService->getTeamWithHighestWithoutWinningStreak($league, $season);
            $highestWithoutLosingStreak = $statsService->getTeamWithHighestWithoutLosingStreak($league, $season);
            $highestWithoutScoringStreak = $statsService->getTeamWithHighestWithoutScoringStreak($league, $season);
            $highestScoredStreak = $statsService->getTeamWithHighestScoredStreak($league, $season);
            $mostPoints = $statsService->getTeamWithMostPoints($league, $season);
            $mostWins = $statsService->getTeamWithMostWins($league, $season);
            $mostDraws = $statsService->getTeamWithMostDraws($league, $season);
            $mostLosses = $statsService->getTeamWithMostLosses($league, $season);
        }

        return $this->render('CompetitionBundle:League:history.html.twig', [
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
        ]);
    }

    public function showAwardsAction(Request $request, $slug)
    {
        $competitionService = $this->getCompetitionService();
        $league = $competitionService->getLeagueBySlug($slug);

        $seasonService = $this->getSeasonService();
        $seasonNumber = $request->query->get('season');
        $season = $seasonService->getLatestOrSpecifiedSeasonForCompetition($league, $seasonNumber);

        return $this->render('CompetitionBundle:League:awards.html.twig', [
            'league' => $league,
            'season' => $season
        ]);
    }

    public function showLadderAction()
    {
        $competitionService = $this->getCompetitionService();
        $league = $competitionService->getCompetitionByName("Ladder");

        $seasonService = $this->getSeasonService();
        $currentSeason = $seasonService->getCurrentSeasonForLeague($league);
        if ($currentSeason == null) {
            $currentSeason = $seasonService->createSeasonForLadder($league);
        }

        $standings = $competitionService->getUserStandingsByLeagueAndSeason($league, $currentSeason);

        return $this->render('CompetitionBundle:League:ladder.html.twig', [
            'league' => $league,
            'standings' => $standings,
            'season' => $currentSeason
        ]);
    }

    public function showFifaKingAction()
    {
        $competitionService = $this->getCompetitionService();
        $fifaKing = $competitionService->getCompetitionByName("Fifa King");

        var_dump($fifaKing);

        return $this->render('CompetitionBundle:Competition:fifaKing.html.twig', [
            
        ]);
    }

    /**
     * @return StatsService
     */
    private function getStatsService()
    {
        return $this->container->get("elite_fifa.stats_service");
    }

    /**
     * @return SeasonService
     */
    private function getSeasonService()
    {
        return $this->container->get("elite_fifa.season_service");
    }

    /**
     * @return CompetitionService
     */
    private function getCompetitionService()
    {
        return $this->container->get("elite_fifa.competition_service");
    }

    /**
     * @return MatchService
     */
    private function getMatchService()
    {
        return $this->container->get("elite_fifa.match_service");
    }

    /**
     * @return RoundService
     */
    private function getRoundService()
    {
        return $this->container->get("elite_fifa.round_service");
    }
}