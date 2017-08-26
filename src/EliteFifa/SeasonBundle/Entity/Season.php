<?php

namespace EliteFifa\SeasonBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\JobBundle\Entity\Job;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\SeasonBundle\Enum\SeasonStatus;

class Season
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var /DateTime $startDate
     */
    private $startDate;

    /**
     * @var /DateTime $endDate
     */
    private $endDate;

    /**
     * @var string
     */
    private $status;

    /**
     * @var int
     */
    private $number;

    /**
     * @var string
     */
    private $renewalType;

    /**
     * @var ArrayCollection|Match[] $matches
     */
    private $matches;

    /**
     * @var ArrayCollection|Competition[] $competitions
     */
    private $competitions;

    /**
     * @var ArrayCollection|Competitor[]
     */
    private $competitors;

    /**
     * @var ArrayCollection|Association[]
     */
    private $associations;

    /**
     * @var ArrayCollection|Job[]
     */
    private $jobs;

    /**
     * @var Region
     */
    private $region;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
        $this->competitions = new ArrayCollection();
        $this->associations = new ArrayCollection();
        $this->competitors = new ArrayCollection();
        $this->jobs = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get startDate
     *
     * @return \Datetime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set startDate
     *
     * @param \Datetime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getRenewalType()
    {
        return $this->renewalType;
    }

    /**
     * @param $renewalType
     */
    public function setRenewalType($renewalType)
    {
        $this->renewalType = $renewalType;
    }

    /**
     * Get endDate
     *
     * @return \Datetime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set endDate
     *
     * @param \Datetime $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isInProgress()
    {
        return ($this->status == SeasonStatus::IN_PROGRESS);
    }

    /**
     * @return bool
     */
    public function isFinished()
    {
        return ($this->status == SeasonStatus::FINISHED);
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        return SeasonStatus::getLabel($this->status);
    }

    /**
     * Has match
     *
     * @param Match $match
     * @return boolean
     */
    public function hasMatch(Match $match)
    {
        return $this->matches->contains($match);
    }

    /**
     * Add match
     *
     * @param Match $match
     */
    public function addMatch(Match $match)
    {
        if (!$this->hasMatch($match)) {
            $this->matches->add($match);
            $match->setSeason($this);
        }
    }

    /**
     * Remove match
     *
     * @param Match $match
     */
    public function removeMatch(Match $match)
    {
        if ($this->hasMatch($match)) {
            $this->matches->removeElement($match);
            $match->removeSeason();
        }
    }

    /**
     * Get matches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * Has competition
     *
     * @param Competition $competition
     * @return boolean
     */
    public function hasCompetition(Competition $competition)
    {
        return $this->competitions->contains($competition);
    }

    /**
     * Add competition
     *
     * @param Competition $competition
     */
    public function addCompetition(Competition $competition)
    {
        if (!$this->hasCompetition($competition)) {
            $this->competitions->add($competition);
            $competition->addSeason($this);
        }
    }

    /**
     * Remove competition
     *
     * @param Competition $competition
     */
    public function removeCompetition(Competition $competition)
    {
        if ($this->hasCompetition($competition)) {
            $this->competitions->removeElement($competition);
            $competition->removeSeason($this);
        }
    }

    /**
     * Get competitions
     *
     * @return ArrayCollection
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }

    /**
     * @param $competitions
     */
    public function setCompetitions($competitions)
    {
        $this->competitions = $competitions;
    }

    /**
     * @return ArrayCollection|Competitor[]
     */
    public function getCompetitors()
    {
        return $this->competitors;
    }

    /**
     * @param $competitors
     */
    public function setCompetitors($competitors)
    {
        $this->competitors = $competitors;
    }

    /**
     * @return ArrayCollection|Association[]
     */
    public function getAssociations()
    {
        return $this->associations;
    }

    /**
     * @param Association[] $associations
     */
    public function setAssociations($associations)
    {
        $this->associations = $associations;
    }

    /**
     * @return ArrayCollection|Job[]
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @param ArrayCollection|Job[] $jobs
     */
    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
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
}
