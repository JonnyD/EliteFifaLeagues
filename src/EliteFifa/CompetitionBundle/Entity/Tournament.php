<?php

namespace EliteFifa\CompetitionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

class Tournament
{
    /**
     * @ORM\OneToMany(targetEntity="EliteFifa\MatchBundle\Entity\Match", mappedBy="tournament", cascade="persist")
     */
    private $matches;

    public function __construct()
    {
        parent::__construct();

        $this->matches = new ArrayCollection();
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
            $match->setTournament($this);
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
            $match->removeTournament();
        }
    }

    /**
     * Get matches
     *
     * @return ArrayCollection
     */
    public function getMatches()
    {
        return $this->matches;
    }
}