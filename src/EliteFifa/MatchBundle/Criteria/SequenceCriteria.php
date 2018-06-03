<?php

namespace EliteFifa\MatchBundle\Criteria;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\SeasonBundle\Entity\Season;

class SequenceCriteria
{
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