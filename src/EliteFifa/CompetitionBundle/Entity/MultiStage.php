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
        foreach ($stages as $stage) {
            $this->addStage($stage);
        }
    }

    /**
     * @param Stage $stage
     * @return bool
     */
    public function hasStage(Stage $stage)
    {
        return $this->stages->contains($stage);
    }

    /**
     * @param Stage $stage
     */
    public function addStage(Stage $stage)
    {
        if (!$this->hasStage($stage)) {
            $this->stages->add($stage);
        }
    }
}
