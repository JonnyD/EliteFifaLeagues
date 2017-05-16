<?php

namespace EliteFifa\CompetitionBundle\Entity;

use EliteFifa\TeamBundle\Entity\Team;

//todo move to appropriate namespace
class ResultsTable
{
    private $matches = [];
    private $results = [];
    private $teams = [];

    /**
     * @param $matches
     */
    public function __construct($matches)
    {
        $this->matches = $matches;

        $this->processTeams();
        $this->processMatches();
    }

    public function processTeams()
    {
        foreach ($this->matches as $match) {
            $team = $match->getHomeTeam();

            if (!$this->hasTeam($team->getId())) {
                $this->teams[] =  $team;
            }
        }
    }

    /**
     * @param $teamId
     * @return bool
     */
    private function hasTeam($teamId)
    {
        return $this->getTeam($teamId) != null;
    }

    /**
     * @param $teamId
     * @return null
     */
    private function getTeam($teamId)
    {
        $found = null;
        foreach ($this->teams as $team) {
            if ($team->getId() === $teamId) {
                $found = $team;
                break;
            }
        }
        return $found;
    }

    /**
     * @param $teamName
     * @return int
     */
    private function getTeamIndex($teamName)
    {
        $index = -1;
        for ($i = 0; $i < count($this->teams); $i++) {
            $team = $this->teams[$i];
            if ($team->getId() === $teamName) {
                $index = $i;
                break;
            }
        }
        return $index;
    }

    public function processMatches()
    {
        foreach ($this->teams as $team) {
            $teamIndex = $this->getTeamIndex($team->getId());

            if (!array_key_exists($teamIndex, $this->results)) {
                $this->results[$teamIndex] = array();
            }

            $this->results[$teamIndex][$teamIndex] = "-";
        }

        foreach ($this->matches as $match) {
            $homeTeam = $match->getHomeTeam();
            $awayTeam = $match->getAwayTeam();

            $homeTeamIndex = $this->getTeamIndex($homeTeam->getId());
            $awayTeamIndex = $this->getTeamIndex($awayTeam->getId());

            if (!array_key_exists($homeTeamIndex, $this->results)) {
                $this->results[$homeTeamIndex] = array();
            }

            $this->results[$homeTeamIndex][$awayTeamIndex] = $match;
        }
    }

    /**
     * @return Team[]
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }
}