<?php

namespace EliteFifa\AssociationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use EliteFifa\CompetitionBundle\Collection\CompetitionCollection;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\SeasonBundle\Entity\Season;

class Association
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
     * @var string $slug
     */
    private $slug;

    /**
     * @var Region
     */
    private $region;

    /**
     * @var CompetitionCollection
     */
    private $competitions;

    /**
     * @var ArrayCollection|Season[]
     */
    private $seasons;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
        $this->seasons = new ArrayCollection();
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
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
            $competition->setAssociation($this);
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
            $competition->removeAssociation();
        }
    }

    /**
     * Get competitions
     *
     * @return CompetitionCollection
     */
    public function getCompetitions()
    {
        return new CompetitionCollection($this->competitions->toArray());
    }

    /**
     * @return ArrayCollection|Season[]
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

    /**
     * @param $seasons
     */
    public function setSeasons($seasons)
    {
        $this->seasons = $seasons;
    }

    /**
     * @param Season $season
     */
    public function addSeason(Season $season)
    {
        if (!$this->hasSeason($season)) {
            $this->seasons->add($season);
        }
    }

    /**
     * @param Season $season
     * @return bool
     */
    public function hasSeason(Season $season)
    {
        return $this->seasons->contains($season);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
