<?php

namespace EliteFifa\MatchBundle\Entity;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\SeasonBundle\Entity\Season;

class Sequence
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $wins;

    /**
     * @var int
     */
    private $draws;

    /**
     * @var int
     */
    private $losses;

    /**
     * @var int
     */
    private $withoutWins;

    /**
     * @var int
     */
    private $withoutLosses;

    /**
     * @var int
     */
    private $withoutDraws;

    /**
     * @var int
     */
    private $withoutGoalsFor;

    /**
     * @var int
     */
    private $withoutGoalsAgainst;

    /**
     * @var string
     */
    private $sequenceType;

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

    public function __construct()
    {
        $this->wins = null;
        $this->draws = null;
        $this->losses = null;
        $this->withoutWins = null;
        $this->withoutDraws = null;
        $this->withoutLosses = null;
        $this->withoutGoalsFor = null;
        $this->withoutGoalsAgainst = null;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     */
    public function setWins(int $wins)
    {
        $this->wins = $wins;
    }

    public function incrementWins()
    {
        $this->wins++;
    }

    /**
     * @return int
     */
    public function getDraws()
    {
        return $this->draws;
    }

    /**
     * @param int $draws
     */
    public function setDraws(int $draws)
    {
        $this->draws = $draws;
    }

    public function incrementDraws()
    {
        $this->draws++;
    }

    /**
     * @return int
     */
    public function getLosses()
    {
        return $this->losses;
    }

    /**
     * @param int $losses
     */
    public function setLosses(int $losses)
    {
        $this->losses = $losses;
    }

    public function incrementLosses()
    {
        $this->losses++;
    }

    /**
     * @return int
     */
    public function getWithoutWins()
    {
        return $this->withoutWins;
    }

    /**
     * @param int $withoutWins
     */
    public function setWithoutWins(int $withoutWins)
    {
        $this->withoutWins = $withoutWins;
    }

    public function incrementWithoutWins()
    {
        $this->withoutWins++;
    }

    /**
     * @return int
     */
    public function getWithoutLosses()
    {
        return $this->withoutLosses;
    }

    /**
     * @param int $withoutLosses
     */
    public function setWithoutLosses(int $withoutLosses)
    {
        $this->withoutLosses = $withoutLosses;
    }

    public function incrementWithoutLosses()
    {
        $this->withoutLosses++;
    }

    /**
     * @return int
     */
    public function getWithoutDraws()
    {
        return $this->withoutDraws;
    }

    /**
     * @param int $withoutDraws
     */
    public function setWithoutDraws(int $withoutDraws)
    {
        $this->withoutDraws = $withoutDraws;
    }

    public function incrementWithoutDraws()
    {
        $this->withoutDraws++;
    }

    /**
     * @return int
     */
    public function getWithoutGoalsFor()
    {
        return $this->withoutGoalsFor;
    }

    /**
     * @param int $withoutGoalsFor
     */
    public function setWithoutGoalsFor(int $withoutGoalsFor)
    {
        $this->withoutGoalsFor = $withoutGoalsFor;
    }

    public function incrementWithoutGoalsFor()
    {
        $this->withoutgoalsFor++;
    }

    /**
     * @return int
     */
    public function getWithoutGoalsAgainst()
    {
        return $this->withoutGoalsAgainst;
    }

    /**
     * @param int $withoutGoalsAgainst
     */
    public function setWithoutGoalsAgainst(int $withoutGoalsAgainst)
    {
        $this->withoutGoalsAgainst = $withoutGoalsAgainst;
    }

    public function incrementWithoutGoalsAgainst()
    {
        $this->withoutGoalsAgainst++;
    }

    /**
     * @return string
     */
    public function getSequenceType()
    {
        return $this->sequenceType;
    }

    /**
     * @param string $sequenceType
     */
    public function setSequenceType(string $sequenceType)
    {
        $this->sequenceType = $sequenceType;
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
}