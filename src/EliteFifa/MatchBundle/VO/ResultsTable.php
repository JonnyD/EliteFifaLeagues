<?php

namespace EliteFifa\MatchBundle\VO;

use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\TeamBundle\Entity\Team;

class ResultsTable
{
    /**
     * @var Match[]
     */
    private $matches;

    /**
     * @param Match[] $matches
     */
    public function __construct($matches)
    {
        $this->matches = $matches;
    }

    /**
     * @return Team[]
     */
    public function getTeams()
    {
        $teams = [];

        foreach ($this->matches as $match) {
            $teams[] = $match->getHomeTeam();
        }

        return $teams;
    }

    /**
     * @return array
     */
    public function getResultsTable()
    {
        $teams = $this->getTeams();

        $resultsTable = [];

        foreach ($teams as $team) {
            $resultsTable[$team->getName()] = [];
        }

        foreach ($this->matches as $match) {
            $homeTeam = $match->getHomeTeam();
            $index = array_search($homeTeam->getName(), $teams);
            $resultsTable[$index][$index] = $match;
        }

        return $resultsTable;
    }
}