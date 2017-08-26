<?php

namespace EliteFifa\CompetitorBundle\Event;

use EliteFifa\CompetitorBundle\Entity\Competitor;
use Symfony\Component\EventDispatcher\Event;

class CompetitorEvent extends Event
{
    /**
     * @var Competitor
     */
    private $competitor;

    /**
     * @param Competitor $competitor
     */
    public function __construct(Competitor $competitor)
    {
        $this->competitor = $competitor;
    }

    /**
     * @return Competitor
     */
    public function getCompetitor()
    {
        return $this->competitor;
    }

    /**
     * @param Competitor $competitor
     */
    public function setCompetitor(Competitor $competitor)
    {
        $this->competitor = $competitor;
    }
}