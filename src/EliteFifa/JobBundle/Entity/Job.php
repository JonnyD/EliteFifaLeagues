<?php

namespace EliteFifa\JobBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\SeasonBundle\Entity\Season;

class Job
{
    /**
     * @var int
     */
    private $id;

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
     * @var Season
     */
    private $season;

    /**
     * @var Competitor
     */
    private $competitor;

    /**
     * @var ArrayCollection|JobApplication[]
     */
    private $jobApplications;

    public function __construct()
    {
        $this->jobApplications = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection|JobApplication[]
     */
    public function getJobApplications()
    {
        return $this->jobApplications;
    }

    /**
     * @param $jobApplications
     */
    public function setJobApplications($jobApplications)
    {
        $this->jobApplications = $jobApplications;
    }

    /**
     * @return int
     */
    public function totalApplications()
    {
        return count($this->jobApplications);
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