<?php

namespace EliteFifa\CompetitionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\JobBundle\Entity\Job;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\RegionBundle\Entity\Region;
use Gedmo\Mapping\Annotation as Gedmo;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\AssociationBundle\Entity\Association;

abstract class Competition
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $code
     */
    private $code;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var bool
     */
    private $main;

    /**
     * @var Region
     */
    private $region;

    /**
     * @var Association $association
     */
    private $association;

    /**
     * @var ArrayCollection|Season[]
     */
    private $seasons;

    /**
     * @var ArrayCollection|Match[]
     */
    private $matches;

    /**
     * @var ArrayCollection|Competitor[]
     */
    private $competitors;

    /**
     * @var Stage
     */
    private $stage;

    /**
     * @var ArrayCollection|Job[]
     */
    private $jobs;

    public function __construct()
    {
        $this->seasons = new ArrayCollection();
        $this->matches = new ArrayCollection();
        $this->competitors = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->main = false;
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return bool
     */
    public function isMain()
    {
        return $this->main;
    }

    /**
     * @param bool $main
     */
    public function setMain(bool $main)
    {
        $this->main = $main;
    }

    /**
     * Set association
     *
     * @param Association $association
     */
    public function setAssociation(Association $association)
    {
        if ($this->association == null) {
            $this->association = $association;
            $association->addCompetition($this);
        }
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
    public function setRegion($region)
    {
        $this->region = $region;
    }

    /**
     * Get association
     *
     * @return Association
     */
    public function getAssociation()
    {
        return $this->association;
    }

    /**
     * Remove association
     */
    public function removeAssociation()
    {
        $this->association->removeCompetition($this);
        $this->association = null;
    }

    /**
     * Has season
     *
     * @param Season $season
     * @return boolean
     */
    public function hasSeason(Season $season)
    {
        return $this->seasons->contains($season);
    }

    /**
     * Add season
     *
     * @param Season $season
     */
    public function addSeason(Season $season)
    {
        if (!$this->hasSeason($season)) {
            $this->seasons->add($season);
            $season->addCompetition($this);
        }
    }

    /**
     * Remove season
     *
     * @param Season $season
     */
    public function removeSeason(Season $season)
    {
        if ($this->hasSeason($season)) {
            $this->seasons->removeElement($season);
            $season->removeCompetition($this);
        }
    }

    /**
     * Get seasons
     *
     * @return ArrayCollection
     */
    public function getSeasons()
    {
        return $this->seasons;
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
            $match->setCompetition($this);
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
     * @return Stage
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * @param Stage $stage
     */
    public function setStage(Stage $stage)
    {
        $this->stage = $stage;
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
}
