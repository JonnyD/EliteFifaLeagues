<?php

namespace EliteFifa\CompetitionBundle\Service;

use EliteFifa\Bundle\Entity\Association;
use EliteFifa\Bundle\Entity\League;
use EliteFifa\Bundle\Repository\LeagueRepository;
use Doctrine\ORM\EntityManager;

//todo deprecated?
class LeagueService
{
    private $leagueRepository;
    private $matchManager;

    public function __construct(LeagueRepository $leagueRepository,
                                MatchManager $matchManager)
    {
        $this->leagueRepository = $leagueRepository;
        $this->matchManager = $matchManager;
    }

    public function createLeague($name, $division, Association $association)
    {
        $league = new League();
        $league->setName($name);
        $league->setDivision($division);
        $league->setAssociation($association);
        return $league;
    }

    public function getLeagueById($id)
    {
        return $this->leagueRepository->find($id);
    }

    public function getLeagueByName($name)
    {
        return $this->leagueRepository->findOneByName($name);
    }

    public function getLeagueBySlug($slug)
    {
        return $this->leagueRepository->findOneBySlug($slug);
    }

    public function getStandingsByLeagueAndSeason($league, $season)
    {
        $standings = $this->leagueRepository->findStandingsByLeagueAndSeason($league, $season);

        /*if ($table == 'home') {
            $standings = $this->leagueStandingRepository->findByLeagueAndSeasonOrderedByHomePoints($league, $season);
        } elseif ($table == 'away') {g
            $standings = $this->leagueStandingRepository->findByLeagueAndSeasonOrderedByAwayPoints($league, $season);
        } else {
            $standings = $this->leagueStandingRepository->findByLeagueAndSeason($league, $season);
        }*/
        return $standings;
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
}