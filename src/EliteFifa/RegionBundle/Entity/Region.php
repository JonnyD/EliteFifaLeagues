<?php

namespace EliteFifa\RegionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\CareerBundle\Entity\Career;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\JobBundle\Entity\Job;
use EliteFifa\SeasonBundle\Entity\Season;

class Region
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var ArrayCollection|Association[]
     */
    private $associations;

    /**
     * @var ArrayCollection|Season[]
     */
    private $seasons;

    /**
     * @var ArrayCollection|Competition[]
     */
    private $competitions;

    /**
     * @var ArrayCollection|Career[]
     */
    private $careers;

    /**
     * @var ArrayCollection|Job[]
     */
    private $jobs;

    public function __construct()
    {
        $this->associations = new ArrayCollection();
        $this->seasons = new ArrayCollection();
        $this->competitions = new ArrayCollection();
        $this->careers = new ArrayCollection();
        $this->jobs = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return ArrayCollection|Association[]
     */
    public function getAssociations()
    {
        return $this->associations;
    }

    /**
     * @param ArrayCollection|Association[] $associations
     */
    public function setAssociations($associations)
    {
        $this->associations = $associations;
    }

    /**
     * @return ArrayCollection|Season[]
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

    /**
     * @param ArrayCollection|Season[] $seasons
     */
    public function setSeasons($seasons)
    {
        $this->seasons = $seasons;
    }

    /**
     * @return ArrayCollection|Competition[]
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }

    /**
     * @param ArrayCollection|Competition[] $competitions
     */
    public function setCompetitions($competitions)
    {
        $this->competitions = $competitions;
    }

    /**
     * @return ArrayCollection|Career[]
     */
    public function getCareers()
    {
        return $this->careers;
    }

    /**
     * @param $careers
     */
    public function setCareers($careers)
    {
        $this->careers = $careers;
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
