<?php

namespace EliteFifa\CompetitionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class GroupStage extends Stage
{
    /**
     * @var ArrayCollection|Competition[]
     */
    private $competitions;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|Competition[]
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }

    /**
     * @param Competition[] $competitions
     */
    public function setCompetitions($competitions)
    {
        foreach ($competitions as $competition) {
            $this->addCompetition($competition);
            $competition->setStage($this);
        }
    }

    /**
     * @param Competition $competition
     * @return bool
     */
    public function hasCompetition(Competition $competition)
    {
        return $this->competitions->contains($competition);
    }

    /**
     * @param Competition $competition
     */
    public function addCompetition(Competition $competition)
    {
        if (!$this->hasCompetition($competition)) {
            $this->competitions->add($competition);
        }
    }
}