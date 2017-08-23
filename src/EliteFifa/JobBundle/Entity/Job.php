<?php

namespace EliteFifa\JobBundle\Entity;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\RegionBundle\Entity\Region;

class Job
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $totalApplications;

    /**
     * @var bool
     */
    private $instant;

    /**
     * @var Region
     */
    private $region;

    /**
     * @var Competition
     */
    private $competition;

    /**
     * @var Competitor
     */
    private $competitor;

    public function __construct()
    {
        $this->totalApplications = 0;
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
    public function getTotalApplications()
    {
        return $this->totalApplications;
    }

    /**
     * @param int $totalApplications
     */
    public function setTotalApplications(int $totalApplications)
    {
        $this->totalApplications = $totalApplications;
    }

    /**
     * @return bool
     */
    public function isInstant()
    {
        return $this->instant;
    }

    /**
     * @param bool $instant
     */
    public function setInstant(bool $instant)
    {
        $this->instant = $instant;
    }

    /**
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param Region $region
     */
    public function setRegion(Region $region)
    {
        $this->region = $region;
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
}