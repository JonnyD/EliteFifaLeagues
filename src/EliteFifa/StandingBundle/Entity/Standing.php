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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTableType(): string
    {
        return $this->tableType;
    }

    /**
     * @param string $tableType
     */
    public function setTableType(string $tableType)
    {
        $this->tableType = $tableType;
    }

    /**
     * @return string
     */
    public function getStandingType(): string
    {
        return $this->standingType;
    }

    /**
     * @param string $standingType
     */
    public function setStandingType(string $standingType)
    {
        $this->standingType = $standingType;
    }

    /**
     * @return Competitor
     */
    public function getCompetitor(): Competitor
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
    public function getCompetition(): Competition
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
    public function getSeason(): Season
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
    public function getPlayed(): int
    {
        return $this->played;
    }

    /**
     * @param int $played
     */
    public function setPlayed(int $played)
    {
        $this->played = $played;
    }

    public function incrementPlayed()
    {
        $this->played++;
    }

    /**
     * @return int
     */
    public function getWon(): int
    {
        return $this->won;
    }

    /**
     * @param int $won
     */
    public function setWon(int $won)
    {
        $this->won = $won;
    }

    public function incrementWon()
    {
        $this->won++;
    }

    /**
     * @return int
     */
    public function getDrawn(): int
    {
        return $this->drawn;
    }

    /**
     * @param int $drawn
     */
    public function setDrawn(int $drawn)
    {
        $this->drawn = $drawn;
    }

    public function incrementDrawn()
    {
        $this->drawn++;
    }

    /**
     * @return int
     */
    public function getLost(): int
    {
        return $this->lost;
    }

    /**
     * @param int $lost
     */
    public function setLost(int $lost)
    {
        $this->lost = $lost;
    }

    public function incrementLost()
    {
        $this->lost++;
    }

    /**
     * @return int
     */
    public function getGoalsFor(): int
    {
        return $this->goalsFor;
    }

    /**
     * @param int $goalsFor
     */
    public function setGoalsFor(int $goalsFor)
    {
        $this->goalsFor = $goalsFor;
    }

    /**
     * @param int $goalsFor
     */
    public function addGoalsFor(int $goalsFor)
    {
        $this->goalsFor = $this->goalsFor + $goalsFor;
    }

    /**
     * @return int
     */
    public function getGoalsAgainst(): int
    {
        return $this->goalsAgainst;
    }

    /**
     * @param int $goalsAgainst
     */
    public function setGoalsAgainst(int $goalsAgainst)
    {
        $this->goalsAgainst = $goalsAgainst;
    }

    /**
     * @param int $goalsAgainst
     */
    public function addGoalsAgainst(int $goalsAgainst)
    {
        $this->goalsAgainst = $this->goalsAgainst + $goalsAgainst;
    }

    /**
     * @return int
     */
    public function getGoalDifference(): int
    {
        return $this->goalDifference;
    }

    /**
     * @param int $goalDifference
     */
    public function setGoalDifference(int $goalDifference)
    {
        $this->goalDifference = $goalDifference;
    }

    public function updateGoalDifference()
    {
        $this->goalDifference = $this->goalsFor - $this->goalsAgainst;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points)
    {
        $this->points = $points;
    }
}
