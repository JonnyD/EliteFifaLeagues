<?php

namespace EliteFifa\MatchBundle\Service;

use Doctrine\ORM\EntityManager;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;

class ResultService
{
    private $resultRepository;
    private $resultTypeRepository;

    public function getResultsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        return $this->resultRepository->findResultsByCompetitionAndSeason($competition, $season);
    }

    public function getResultsOrderedByOldest()
    {
        return $this->resultRepository->findAllOrderedByOldest();
    }

    public function getPreviousResultByTeam(Team $team)
    {
        return $this->resultRepository->findPreviousResultForTeam($team);
    }

    public function getResultsByTeam(Team $team, Competition $competition, Season $season)
    {
        return $this->resultRepository->findResultsForTeam($team, $competition, $season, 0);
    }

    public function getHomeResultsByTeam(Team $team, Competition $competition, Season $season)
    {
        return $this->resultRepository->findHomeResultsForTeam($team, $competition, $season, 0);
    }

    public function getAwayResultsByTeam(Team $team, Competition $competition, Season $season)
    {
        return $this->resultRepository->findAwayResultsForTeam($team, $competition, $season, 0);
    }

    public function getFormByResults($results, $limit)
    {
        $form = array();
        $resultsCount = count($results);
        if ($limit > $resultsCount) {
            $limit = $resultsCount;
        }
        for ($i = 0; $i < $limit; $i++) {
            $result = $results[$i];
            $code = $result->getResultType()->getCode();
            array_push($form, $this->createFormArray($code));
        }
        return $form;
    }

    public function createFormArray($code)
    {
        $form = array();
        $form['code'] = $code;
        $form['points'] = $this->getPointsByCode($code);
        return $form;
    }

    public function getPointsByCode($code)
    {
        $points = 0;
        if ($code == "W") {
            $points = 3;
        } else if ($code == "D") {
            $points = 1;
        }
        return $points;
    }

    public function convertFormToString($form)
    {
        $formString = "";
        foreach ($form as $key => $value) {
            $code = $value['code'];
            $formString .= $code;
        }
        return $formString;
    }

    public function convertFormStringToArray($formString)
    {
        return str_split($formString);
    }

    public function getPointsFromForm($form)
    {
        $points = 0;
        foreach ($form as $key => $value) {
            $points += $value['points'];
        }
        return $points;
    }

    public function createResultByMatchAndTeam($match, $team)
    {
        $homeTeam = $match->getHomeTeam();
        $awayTeam = $match->getAwayTeam();
        $homeScore = $match->getHomeScore();
        $awayScore = $match->getAwayScore();

        $resultCode = $this->calculateResultCode($homeTeam, $awayTeam, $homeScore, $awayScore, $team);
        $resultType = $this->getResultTypeByCode($resultCode);
        $result = $this->createResult($team, $match, $resultType);

        return $result;
    }


    public function getResultTypeByCode($code)
    {
        return $this->resultTypeRepository->findOneByCode($code);
    }

    public function getBiggestWinByResults($results)
    {
        $biggestWin = $results[0]->getMatch();
        foreach ($results as $result) {
            $match = $result->getMatch();
            $goalDifference = $this->getGoalDifferenceByMatch($match);
            if ($goalDifference >= $this->getGoalDifferenceByMatch($biggestWin)) {
                $biggestWin = $match;
            }
        }
        return $biggestWin;
    }

    public function getBiggestLossByResults($results)
    {
        $biggestLoss = $results[0]->getMatch();
        foreach ($results as $result) {
            $match = $result->getMatch();
            $goalDifference = $this->getGoalDifferenceByMatch($match);
            if ($goalDifference <= $this->getGoalDifferenceByMatch($biggestLoss)) {
                $biggestLoss = $match;
            }
        }
        return $biggestLoss;
    }

    public function getGoalDifferenceByMatch(Match $match)
    {
        $homeScore = $match->getHomeScore();
        $awayScore = $match->getAwayScore();
        $goalDifference = $homeScore - $awayScore;
        return max($goalDifference, 0);
    }

    public function getHighestScoringMatchByResults($results)
    {
        $highestScoring = $results[0]->getMatch();
        foreach ($results as $result) {
            $match = $result->getMatch();
            $goals = $this->getAmountOfGoalsByMatch($match);
            if ($goals >= $this->getAmountOfGoalsByMatch($highestScoring)) {
                $highestScoring = $match;
            }
        }
        return $highestScoring;
    }

    public function getAmountOfGoalsByMatch(Match $match)
    {
        $homeScore = $match->getHomeScore();
        $awayScore = $match->getAwayScore();
        $total = $homeScore + $awayScore;
        return $total;
    }
}