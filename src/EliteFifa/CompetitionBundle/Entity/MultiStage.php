<?php

namespace EliteFifa\CompetitionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class MultiStage extends Competition
{
    /**
     * @var ArrayCollection|Stage[]
     */
    private $stages;

    public function __construct()
    {
        parent::__construct();

        $this->stages = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|Stage[]
     */
    public function getStages()
    {
        return $this->stages;
    }

    /**
     * @param ArrayCollection|Stage[] $stages
     */
    public function setStages($stages)
    {
        $this->stages = $stages;
    }
}
