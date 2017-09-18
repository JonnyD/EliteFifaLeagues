<?php

namespace EliteFifa\MatchBundle\Event;

use EliteFifa\MatchBundle\Entity\Match;
use Symfony\Component\EventDispatcher\Event;

class MatchEvent extends Event
{
    /**
     * @var Match
     */
    private $match;

    /**
     * @param Match $match
     */
    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }

    /**
     * @param Match $match
     */
    public function setMatch(Match $match)
    {
        $this->match = $match;
    }
}