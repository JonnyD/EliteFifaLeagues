<?php

namespace EliteFifa\StandingBundle\Criteria;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\SeasonBundle\Entity\Season;

class StandingCriteria
{
    /**
     * @var string
     */
    private $tableType;

    /**
     * @var string
     */
    private $standingType;

    /**
     * @var Competition
     */
    private $competition;

    /**
     * @var Season
     */
    private $season;

    /**
     * @var array
     */
    private $sort;

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
     * @return array
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param array $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }
}
