<?php

namespace EliteFifa\CompetitionBundle\Entity;

class KnockoutStage extends Stage
{
    /**
     * @var Competition
     */
    private $competition;

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
        $competition->setStage($this);
    }
}