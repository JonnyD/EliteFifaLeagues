<?php

namespace EliteFifa\StandingBundle\Entity;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\SeasonBundle\Entity\Season;

class Standing
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $tableType;

    /**
     * @var string
     */
    private $standingType;

    /**
     * @var Competitor
     */
    private $competitor;

    /**
     * @var Competition
     */
    private $competition;

    /**
     * @var Season
     */
    private $season;

    /**
     * @var int
     */
    private $played;

    /**
     * @var int
     */
    private $won;

    /**
     * @var int
     */
    private $drawn;

    /**
     * @var int
     */
    private $lost;

    /**
     * @var int
     */
    private $goalsFor;

    /**
     * @var int
     */
    private $goalsAgainst;

    /**
     * @var int
     */
    private $goalDifference;

    /**
     * @var int
     */
    private $points;

    public function __construct()
    {
        $this->played = 0;
        $this->won = 0;
        $this->drawn = 0;
        $this->lost = 0;
        $this->goalsFor = 0;
        $this->goalsAgainst = 0;
        $this->goalDifference = 0;
        $this->points = 0;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTableType()
    {
        return $this->tableType;
    }

    /**
     * @param string $tableType
     */
    public function setTableType($tableType)
    {
        $this->tableType = $tableType;
    }

    /**
     * @return string
     */
    public function getStandingType()
    {
        return $this->standingType;
    }

    /**
     * @param string $standingType
     */
    public function setStandingType($standingType)
    {
        $this->standingType = $standingType;
    }

    /**
     * @return Competitor
     */
    public function getCompetitor()
    {
        return $this->competitor;
    }

    /**
     * @param Competitor $competitor
     */
    public function setCompetitor(Competitor $competitor)
    {
        $this->competitor = $competitor;
    }

    /**
     * @return Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * @param Competition $competition
     */
    public function setCompetition(Competition $competition)
    {
        $this->competition = $competition;
    }

    /**
     * @return Season
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param Season $season
     */
    public function setSeason(Season $season)
    {
        $this->season = $season;
    }

    /**
     * @return int
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * @param int $played
     */
    public function setPlayed($played)
    {
        $this->played = $played;
    }

    /**
     * @return int
     */
    public function getWon()
    {
        return $this->won;
    }

    /**
     * @param int $won
     */
    public function setWon($won)
    {
        $this->won = $won;
    }

    /**
     * @return int
     */
    public function getDrawn()
    {
        return $this->drawn;
    }

    /**
     * @param int $drawn
     */
    public function setDrawn($drawn)
    {
        $this->drawn = $drawn;
    }

    /**
     * @return int
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * @param int $lost
     */
    public function setLost($lost)
    {
        $this->lost = $lost;
    }

    /**
     * @return int
     */
    public function getGoalsFor()
    {
        return $this->goalsFor;
    }

    /**
     * @param int $goalsFor
     */
    public function setGoalsFor($goalsFor)
    {
        $this->goalsFor = $goalsFor;
    }

    /**
     * @return int
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * @param int $goalsAgainst
     */
    public function setGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst = $goalsAgainst;
    }

    /**
     * @return int
     */
    public function getGoalDifference()
    {
        return $this->goalDifference;
    }

    /**
     * @param int $goalDifference
     */
    public function setGoalDifference($goalDifference)
    {
        $this->goalDifference = $goalDifference;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }
}
