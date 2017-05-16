<?php

namespace EliteFifa\CompetitionBundle\Service;

use EliteFifa\Bundle\Entity\LeagueStanding;
use EliteFifa\Bundle\Repository\CompetitionRepository;
use Doctrine\ORM\EntityManager;
use EliteFifa\Bundle\Entity\Competition;
use EliteFifa\Bundle\Entity\Season;
use EliteFifa\Bundle\Repository\MatchRepository;
use EliteFifa\Bundle\Repository\ParticipantRepository;
use EliteFifa\Bundle\Repository\TeamRepository;
use EliteFifa\Bundle\Repository\UserRepository;

//TODO REFACTOR - TOO MANY DEPENDENCIES
class OldCompetitionService
{
    private $leagueRepository;
    private $teamRepository;
    private $userRepository;
    private $matchRepository;
    private $participantRepository;

    public function __construct(CompetitionRepository $competitionRepository,
                                TeamRepository $teamRepository,
                                UserRepository $userRepository,
                                MatchRepository $matchRepository,
                                ParticipantRepository $participantRepository)
    {
        $this->leagueRepository = $competitionRepository;
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
        $this->matchRepository = $matchRepository;
        $this->participantRepository = $participantRepository;
    }

    public function getLeagueById($id)
    {
        return $this->leagueRepository->find($id);
    }

    public function getCompetitionByName($name)
    {
        return $this->leagueRepository->findOneByName($name);
    }

    public function getCompetitionBySlug($slug)
    {
        return $this->leagueRepository->findOneBySlug($slug);
    }

    public function getStandingsByCompetitionAndSeason($competition, $season)
    {
        $results = $this->leagueRepository->findStandingsByLeagueAndSeason($competition, $season);
        
        $standings = array();
        foreach ($results as $result) {
            $standing = new LeagueStanding();
            $standing->setPlayed($result["played"]);
            $standing->setWon($result["won"]);
            $standing->setLost($result["lost"]);
            $standing->setDrawn($result["drawn"]);
            $standing->setGoalsFor($result["goalsFor"]);
            $standing->setGoalsAgainst($result["goalsAgainst"]);
            $standing->setPoints($result["points"]);
            $standing->setPointsPerGame($result["ppg"]);
            $standing->setCleanSheets($result["cleanSheets"]);
            $standing->setFailedToScore($result["failedToScore"]);
            $standing->setPosition($result["position"]);
            $standing->setHomePlayed($result["homePlayed"]);
            $standing->setAwayPlayed($result["awayPlayed"]);
            $standing->setHomeWon($result["homeWon"]);
            $standing->setHomeDrawn($result["homeDrawn"]);
            $standing->setHomeLost($result["homeLost"]);
            $standing->setAwayWon($result["awayWon"]);
            $standing->setAwayDrawn($result["awayDrawn"]);
            $standing->setAwayLost($result["awayLost"]);
            $standing->setHomeGoalsAgainst($result["homeGoalsAgainst"]);
            $standing->setHomeGoalsFor($result["homeGoalsFor"]);
            $standing->setHomeGoalDifference($result["homeGoalDifference"]);
            $standing->setAwayGoalsAgainst($result["awayGoalsAgainst"]);
            $standing->setAwayGoalsFor($result["awayGoalsFor"]);
            $standing->setAwayGoalDifference($result["awayGoalDifference"]);
            $standing->setBothTeamsScored($result["bothTeamsScored"]);

            $team = $this->teamRepository->find($result["teamId"]);
            $standing->setTeam($team);

            $user = $this->userRepository->find($result["userId"]);
            $standing->setUser($user);

            $previousMatch = $this->matchRepository->findPreviousMatchForTeam($team, $competition, $season);
            $previousStanding = $this->leagueRepository->findTeamStandingsByMatchLeagueSeason($team, $previousMatch, $competition, $season);
            $standing->setPreviousPosition($previousStanding["position"]);

            $standings[] = $standing;
        }

        return $standings;
    }

    public function getHomeStandingsByCompetitionAndSeason($competition, $season)
    {
        return $this->leagueRepository->findHomeStandingsByCompetitionAndSeason($competition, $season);
    }

    public function getAwayStandingsByCompetitionAndSeason($competition, $season)
    {
        return $this->leagueRepository->findAwayStandingsByCompetitionAndSeason($competition, $season);
    }

    public function getPositionsForTeamByCompetitionAndSeason($team, $competition, $season)
    {
        $positions = array();
        $matches = $this->matchRepository->findMatchesByTeamCompetitionSeason($team, $competition, $season);
        for ($i = 1; $i <= 22; $i++) {
            $standing = $this->leagueRepository->findTeamStandingsByRoundLeagueSeason($team, $i, $competition, $season);
            $positions[] = $standing["position"];
        }
        return $positions;
    }

    public function getUserStandingsByLeagueAndSeason($league, $season)
    {
        $standings = $this->leagueRepository->findUserStandingsByLeagueAndSeason($league, $season);
        return $standings;
    }

    /*
    public function updateStandingsByMatch($match)
    {
        $this->updateStanding($match, $match->getHomeTeam(), $match->getHomeScore(), $match->getAwayScore());
        $this->updateStanding($match, $match->getAwayTeam(), $match->getAwayScore(), $match->getHomeScore());
    }

    public function updateStanding($match, $team, $goalsFor, $goalsAgainst)
    {
        $standing = $this->getOrCreateStanding($team, $match->getLeague(), $match->getSeason());

        $standing->setPlayed($standing->getPlayed() + 1);
        $this->calculateGoals($standing, $goalsFor, $goalsAgainst);

        $resultType = $this->matchManager->calculateResultType($match, $team);
        $this->calculateResult($standing, $resultType);

        $this->persist($standing);
    }

    public function updateStandingByResult(LeagueStanding $leagueStanding, $result)
    {
        $match = $result->getMatch();
        $team = $result->getTeam();

        $isHome = $match->isHome($team);
        $isAway = $match->isAway($team);

        $homeScore = $match->getHomeScore();
        $awayScore = $match->getAwayScore();

        $leagueStanding->incrementPlayed();
        if ($isHome) {
            $leagueStanding->incrementGoalsFor($homeScore);
            $leagueStanding->incrementGoalsAgainst($awayScore);

            $leagueStanding->incrementHomePlayed();
            $leagueStanding->incrementHomeGoalsFor($homeScore);
            $leagueStanding->incrementHomeGoalsAgainst($awayScore);
        } else if ($isAway) {
            $leagueStanding->incrementGoalsFor($awayScore);
            $leagueStanding->incrementGoalsAgainst($homeScore);

            $leagueStanding->incrementAwayPlayed();
            $leagueStanding->incrementAwayGoalsFor($awayScore);
            $leagueStanding->incrementAwayGoalsAgainst($homeScore);
        }

        $code = $result->getCode();
        if ($code == "W") {
            $leagueStanding->incrementWon();
            $leagueStanding->incrementPoints(3);

            if ($isHome) {
                $leagueStanding->incrementHomeWon();
                $leagueStanding->incrementHomePoints(3);
            } else if ($isAway) {
                $leagueStanding->incrementAwayWon();
                $leagueStanding->incrementAwayPoints(3);
            }
        } else if ($code == "L") {
            $leagueStanding->incrementLost();

            if ($isHome) {
                $leagueStanding->incrementHomeLost();
            } else if ($isAway) {
                $leagueStanding->incrementAwayLost();
            }
        } else if ($code == "D") {
            $leagueStanding->incrementDrawn();
            $leagueStanding->incrementPoints(1);

            if ($isHome) {
                $leagueStanding->incrementHomeDrawn();
                $leagueStanding->incrementHomePoints(1);
            } else if ($isAway) {
                $leagueStanding->incrementAwayDrawn();
                $leagueStanding->incrementAwayPoints(1);
            }
        }
    }

    public function calculateResult($standing, $resultType)
    {
        if ($resultType == "W") {
            $standing->setWon($standing->getWon() + 1);
            $standing->setPoints($standing->getPoints() + 3);
        } else if ($resultType == "L") {
            $standing->setLost($standing->getLost() + 1);
        } else if ($resultType == "D") {
            $standing->setDrawn($standing->getDrawn() + 1);
            $standing->setPoints($standing->getPoints() + 1);
        }
    }

    public function calculateGoals($standing, $goalsFor, $goalsAgainst)
    {
        $standing->setGoalsFor($standing->getGoalsFor() + $goalsFor);
        $standing->setGoalsAgainst($standing->getGoalsAgainst() + $goalsAgainst);
    }
    */
    public function getCurrentPositionForTeamByLeagueAndSeason($team, $league, $season)
    {
        return $this->leagueRepository->findCurrentPositionForTeamByLeagueAndSeason($team, $league, $season);
    }

    public function getCurrentPositionForTeamByStanding($standing)
    {
        return $this->leagueRepository->findCurrentPositionForTeamByStanding($standing);
    }

    public function orderTeamsFormByPoints($teamsForm)
    {
        $teamsFormOrder = array();
        foreach ($teamsForm as $teamForm) {
            $teamsFormOrder[] = $teamForm['points'];
        }
        array_multisort($teamsFormOrder, SORT_DESC, $teamsForm);
        return $teamsForm;
    }

    public function assignCurrentPositionByStandings($standings)
    {
        foreach ($standings as $standing) {
            $position = $this->getCurrentPositionForTeamByStanding($standing);
            $standing->setPosition($position);
        }
    }

    public function getRelegatedTeamsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        return $this->leagueRepository->findRelegatedTeamsByCompetitionAndSeason($competition, $season);
    }

    public function getPromotedTeamsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        return $this->leagueRepository->findPromotedTeamsByCompetitionAndSeason($competition, $season);
    }

    public function getStandingFromMatches($matches, $team, $user)
    {
        $played = 0;
        $won = 0;
        $drawn = 0;
        $lost = 0;
        $goalsFor = 0;
        $goalsAgainst = 0;
        $points = 0;
        foreach ($matches as $match) {
            $result = $match->getResult($user);
            ++$played;
            if ($result == "Win") {
                ++$won;
                $points += 3;
            } else if ($result == "Draw") {
                ++$drawn;
                $points += 1;
            } else if ($result == "Loss") {
                ++$lost;
            }
        }

        $standing = new LeagueStanding();
        $standing->setPlayed($played);
        $standing->setWon($won);
        $standing->setDrawn($drawn);
        $standing->setLost($lost);
        $standing->setPoints($points);
        $standing->setTeam($team);

        return $standing;
    }

    public function getFormStandingsByCompetitionAndSeason($competition, $season, $amount)
    {
        $formStandings = array();
        $participants = $this->participantRepository->findParticipantsByCompetitionAndSeason($competition, $season);
        foreach ($participants as $participant) {
            $team = $participant->getTeam();
            $user = $team->getUser();
            $matches = $this->matchRepository->findLastXMatchesPlayed($team, $amount);
            $standing = $this->getStandingFromMatches($matches, $team, $user);
            $formStandings[] = $standing;
        }
        usort($formStandings, array("EliteFifa\Bundle\Entity\LeagueStanding", "sortPoints"));
        return $formStandings;
    }

    public function getHomeFormStandingsByCompetitionAndSeason($competition, $season, $amount)
    {
        $formStandings = array();
        $participants = $this->participantRepository->findParticipantsByCompetitionAndSeason($competition, $season);
        foreach ($participants as $participant) {
            $team = $participant->getTeam();
            $user = $team->getUser();
            $matches = $this->matchRepository->findLastXHomeMatchesPlayed($team, $amount);
            $standing = $this->getStandingFromMatches($matches, $team, $user);
            $formStandings[] = $standing;
        }
        usort($formStandings, array("EliteFifa\Bundle\Entity\LeagueStanding", "sortPoints"));
        return $formStandings;
    }

    public function getAwayFormStandingsByCompetitionAndSeason($competition, $season, $amount)
    {
        $formStandings = array();
        $participants = $this->participantRepository->findParticipantsByCompetitionAndSeason($competition, $season);
        foreach ($participants as $participant) {
            $team = $participant->getTeam();
            $user = $team->getUser();
            $matches = $this->matchRepository->findLastXAwayMatchesPlayed($team, $amount);
            $standing = $this->getStandingFromMatches($matches, $team, $user);
            $formStandings[] = $standing;
        }
        usort($formStandings, array("EliteFifa\Bundle\Entity\LeagueStanding", "sortPoints"));
        return $formStandings;
    }
}