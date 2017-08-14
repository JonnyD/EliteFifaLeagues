<?php

namespace EliteFifa\CompetitorBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\Entity\User;

class Competitor
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Team
     */
    private $team;

    /**
     * @var User
     */
    private $user;

    /**
     * @var ArrayCollection|Competition[]
     */
    private $competitions;

    /**
     * @var Season
     */
    private $season;

    /**
     * @var ArrayCollection|Match[]
     */
    private $homeMatches;

    /**
     * @var ArrayCollection|Match[]
     */
    private $awayMatches;

    public function __construct()
    {
        $this->competitions = new ArrayCollection();
        $this->homeMatches = new ArrayCollection();
        $this->awayMatches = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param Team $team
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return ArrayCollection|Competition[]
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }

    /**
     * @param ArrayCollection|Competition[] $competitions
     */
    public function setCompetitions($competitions)
    {
        foreach ($competitions as $competition) {
            $this->addCompetition($competition);
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

    /**
     * @return Season
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param Season $season
     */
    public function setSeason(Season $season)
    {
        $this->season = $season;
    }

    /**
     * @return ArrayCollection|Match[]
     */
    public function getHomeMatches()
    {
        return $this->homeMatches;
    }

    /**
     * @param ArrayCollection|Match[] $matches
     */
    public function setHomeMatches($matches)
    {
        foreach ($matches as $match) {
            $this->addHomeMatch($match);
        }
    }

    /**
     * @param Match $match
     * @return bool
     */
    public function hasHomeMatch(Match $match)
    {
        return $this->homeMatches->contains($match);
    }

    /**
     * @param Match $match
     */
    public function addHomeMatch(Match $match)
    {
        if (!$this->hasHomeMatch($match)) {
            $this->homeMatches->add($match);
        }
    }

    /**
     * @return ArrayCollection|Match[]
     */
    public function getAwayMatches()
    {
        return $this->awayMatches;
    }

    /**
     * @param $matches
     */
    public function setAwayMatches($matches)
    {
        foreach ($matches as $match) {
            $this->addAwayMatch($match);
        }
    }

    /**
     * @param Match $match
     * @return bool
     */
    public function hasAwayMatch(Match $match)
    {
        return $this->awayMatches->contains($match);
    }

    /**
     * @param Match $match
     */
    public function addAwayMatch(Match $match)
    {
        if (!$this->hasAwayMatch($match)) {
            $this->awayMatches->add($match);
        }
    }
}
