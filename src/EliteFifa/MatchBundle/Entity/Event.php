<?php

namespace EliteFifa\MatchBundle\Entity;

use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\PlayerBundle\Entity\Player;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

class Event
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var EventType $eventType
     */
    private $eventType;

    /**
     * @var Match $match
     */
    private $match;

    /**
     * @var Team $team
     */
    private $team;

    /**
     * @var Player $player
     */
    private $player;

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
     * Set eventType
     *
     * @param EventType $eventType
     */
    public function setEventType(EventType $eventType)
    {
        if ($this->eventType == null) {
            $this->eventType = $eventType;
            $eventType->addEvent($this);
        }
    }

    /**
     * Get eventType
     *
     * @return EventType
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Remove eventType
     */
    public function removeEventType()
    {
        $this->eventType->removeEvent($this);
        $this->eventType = null;
    }

    /**
     * Set player
     *
     * @param Player $player
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
    }

    /**
     * Get player
     *
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Remove player
     */
    public function removePlayer()
    {
        $this->player = null;
    }

    /**
     * Set match
     *
     * @param Match $match
     */
    public function setMatch(Match $match)
    {
        $this->match = $match;
    }

    /**
     * Get match
     *
     * @return Match
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Remove match
     */
    public function removeMatch()
    {
        $this->match = null;
    }

    /**
     * Set team
     *
     * @param Team $team
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;
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
     * Remove team
     */
    public function removeTeam()
    {
        $this->team = null;
    }

}