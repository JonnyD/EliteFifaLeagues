<?php

namespace EliteFifa\MatchBundle\Entity;

use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\PlayerBundle\Entity\Player;
use Doctrine\ORM\Mapping as ORM;

class Goal
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var Match $match
     */
    private $match;

    /**
     * @var Player $player
     */
    private $player;

    /**
     * @var Team $team
     */
    private $team;

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
     * Set match
     *
     * @param Match $match
     */
    public function setMatch(Match $match)
    {
        if ($this->match == null) {
            $this->match = $match;
            $match->addGoal($this);
        }
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
        if ($this->team == null) {
            $this->team = $team;
            $team->addGoal($this);
        }
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