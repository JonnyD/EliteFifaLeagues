<?php

namespace EliteFifa\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\TeamBundle\Entity\Team;
use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser implements UserInterface, \Serializable
{
    /**
     * @var int $id
     */
    protected $id;

    /**
     * @var Team $team
     */
    private $team;

    /**
     * @var ArrayCollection|Match $homeMatches
     */
    private $homeMatches;

    /**
     * @var ArrayCollection|Match[] $awayMatches
     */
    private $awayMatches;

    /**
     * @var ArrayCollection|Competitor[]
     */
    private $competitors;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->homeMatches = new ArrayCollection();
        $this->awayMatches = new ArrayCollection();
        $this->competitors = new ArrayCollection();
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            ) = unserialize($serialized);
    }

    /**
     * Get team
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set team
     *
     * @param Team $team
     */
    public function setTeam(Team $team)
    {
        if ($this->team == null) {
            $this->team = $team;
            $team->setUser($this);
        }
    }

    /**
     * Has homeMatch
     *
     * @param Match $match
     * @return boolean
     */
    public function hasHomeMatch(Match $match)
    {
        return $this->homeMatches->contains($match);
    }

    /**
     * Add homeMatch
     *
     * @param Match $match
     */
    public function addHomeMatch(Match $match)
    {
        if (!$this->hasHomeMatch($match)) {
            $this->homeMatches->add($match);
            $match->setHomeUser($this);
        }
    }

    /**
     * Remove homeMatch
     *
     * @param Match $match
     */
    public function removeHomeMatch(Match $match)
    {
        $this->homeMatches->remove($match);
    }

    /**
     * Get homeMatches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomeMatches()
    {
        return $this->homeMatches;
    }

    /**
     * Has awayMatch
     *
     * @param Match $match
     * @return boolean
     */
    public function hasAwayMatch($match)
    {
        return $this->awayMatches->contains($match);
    }

    /**
     * Add awayMatch
     *
     * @param Match $match
     */
    public function addAwayMatch($match)
    {
        if (!$this->hasAwayMatch($match)) {
            $this->awayMatches->add($match);
            $match->setAwayUser($this);
        }
    }

    /**
     * Remove awayMatch
     *
     * @param Match $match
     */
    public function removeAwayMatch($match)
    {
        $this->awayMatches->remove($match);
    }

    /**
     * Get awayMatches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAwayMatches()
    {
        return $this->awayMatches;
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
}
