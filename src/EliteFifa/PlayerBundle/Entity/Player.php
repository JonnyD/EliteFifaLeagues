<?php

namespace EliteFifa\PlayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EliteFifa\TeamBundle\Entity\Team;
use Gedmo\Mapping\Annotation as Gedmo;

class Player
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $firstName
     */
    private $firstName;

    /**
     * @var string $lastName
     */
    private $lastName;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var Team $team
     */
    protected $team;

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
     * Set firstName
     *
     * @param string
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->firstName . " " . $this->lastName;
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
     * Remove team
     */
    public function removeTeam()
    {
        $this->team->removePlayer($this);
        $this->team = null;
    }

    /**
     * Set team
     *
     * @param  Team $team
     * @return Player
     */
    public function setTeam(Team $team = null)
    {
        if ($this->team == null) {
            $this->team = $team;
            $team->addPlayer($this);
        }

        return $this;
    }

    /**
     * Get team
     *
     * @return \EliteFifa\Bundle\Entity\Team
     */
    public function getTeam()
    {
        return $this->team;
    }
}