<?php

namespace EliteFifa\StadiumBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EliteFifa\TeamBundle\Entity\Team;
use Gedmo\Mapping\Annotation as Gedmo;

class Stadium
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
     * @var ArrayCollection|Team[] $teams
     */
    private $teams;

    public function __construct()
    {
        $this->teams =  new ArrayCollection();
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
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Has team
     *
     * @param Team $team
     * @return boolean
     */
    public function hasTeam(Team $team)
    {
        return $this->teams->contains($team);
    }

    /**
     * Add team
     *
     * @param Team $team
     */
    public function addTeam(Team $team)
    {
        if (!$this->hasTeam($team)) {
            $this->teams->add($team);
            $team->setStadium($this);
        }
    }

    /**
     * Remove team
     *
     * @param Team $team
     */
    public function removeTeam(Team $team)
    {
        if ($this->hasTeam($team)) {
            $this->teams->removeElement($team);
            $team->removeStadium();
        }
    }

    /**
     * Get teams
     *
     * @return ArrayCollection
     */
    public function getTeams()
    {
        return $this->teams;
    }
}