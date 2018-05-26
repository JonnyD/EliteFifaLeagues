<?php

namespace EliteFifa\MatchBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\Entity\User;

class Match
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var Competitor
     */
    private $homeCompetitor;

    /**
     * @var Competitor
     */
    private $awayCompetitor;

    /**
     * @var Team $homeTeam
     */
    private $homeTeam;

    /**
     * @var Team $awayTeam
     */
    private $awayTeam;

    /**
     * @var User $homeUser
     */
    private $homeUser;

    /**
     * @var User $awayUser
     */
    private $awayUser;

    /**
     * @var Competition $competition
     */
    private $competition;

    /**
     * @var Season $season
     */
    private $season;

    /**
     * @var Round $round
     */
    private $round;

    /**
     * @var string
     */
    private $status;

    /**
     * @var ArrayCollection|Event[] $events
     */
    private $events;

    /**
     * @var int $homeScore
     */
    private $homeScore;

    /**
     * @var int $awayScore
     */
    private $awayScore;

    /**
     * @var \DateTime $reported
     */
    private $reported;

    /**
     * @var \DateTime $confirmed
     */
    private $confirmed;

    /**
     * @var bool $simulated
     */
    private $simulated;

    /**
     * @var bool $ranking
     */
    private $ranking;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->simulated = false;
        $this->ranking = false;
    }

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
     * @return Competitor
     */
    public function getHomeCompetitor()
    {
        return $this->homeCompetitor;
    }

    /**
     * @param Competitor $homeCompetitor
     */
    public function setHomeCompetitor(Competitor $homeCompetitor)
    {
        $this->homeCompetitor = $homeCompetitor;
    }

    /**
     * @return Competitor
     */
    public function getAwayCompetitor()
    {
        return $this->awayCompetitor;
    }

    /**
     * @param Competitor $awayCompetitor
     */
    public function setAwayCompetitor(Competitor $awayCompetitor)
    {
        $this->awayCompetitor = $awayCompetitor;
    }

    /**
     * Set homeTeam
     *
     * @param Team $homeTeam
     * @return Match
     */
    public function setHomeTeam(Team $homeTeam)
    {
        if ($this->homeTeam == null) {
            $this->homeTeam = $homeTeam;
            $homeTeam->addHomeMatch($this);
        }

        return $this;
    }

    /**
     * Remove homeTeam
     *
     * @return Match
     */
    public function removeHomeTeam()
    {
        $this->homeTeam = null;

        return $this;
    }

    /**
     * Get homeTeam
     *
     * @return Team
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * Set awayTeam
     *
     * @param Team $awayTeam
     * @return Match
     */
    public function setAwayTeam(Team $awayTeam)
    {
        if ($this->awayTeam == null) {
            $this->awayTeam = $awayTeam;
            $awayTeam->addAwayMatch($this);
        }

        return $this;
    }

    /**
     * Get awayTeam
     *
     * @return Team
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * Remove awayTeam
     *
     * @return Team
     */
    public function removeAwayTeam()
    {
        $this->awayTeam = null;

        return $this;
    }

    /**
     * Set homeUser
     *
     * @param User $user
     */
    public function setHomeUser(User $user)
    {
        if ($this->homeUser == null) {
            $this->homeUser = $user;
            $user->addHomeMatch($this);
        }
    }

    /**
     * Get homeUser
     *
     * @return User
     */
    public function getHomeUser()
    {
        return $this->homeUser;
    }

    /**
     * Remove homeUser
     *
     */
    public function removeHomeUser()
    {
        $this->homeUser = null;
    }

    /**
     * Set awayUser
     *
     * @param User $user
     */
    public function setAwayUser(User $user)
    {
        if ($this->awayUser == null) {
            $this->awayUser = $user;
            $user->addAwayMatch($this);
        }
    }

    /**
     * Get awayUser
     *
     * @return User
     */
    public function getAwayUser()
    {
        return $this->awayUser;
    }

    /**
     * Remove awayUser
     */
    public function removeAwayUser()
    {
        $this->awayUser = null;
    }

    /**
     * Set competition
     *
     * @param Competition $competition
     */
    public function setCompetition(Competition $competition)
    {
        if ($this->competition == null) {
            $this->competition = $competition;
            $competition->addMatch($this);
        }
    }

    /**
     * Get competition
     *
     * @return Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Remove competition
     */
    public function removeCompetition()
    {
        $this->competition = null;
    }

    /**
     * Set season
     *
     * @param Season $season
     */
    public function setSeason(Season $season)
    {
        if ($this->season == null) {
            $this->season = $season;
            $season->addMatch($this);
        }
    }

    /**
     * Get season
     *
     * @return Season
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Remove season
     */
    public function removeSeason()
    {
        $this->season = null;
    }

    /**
     * Set round
     *
     * @param Round $round
     */
    public function setRound(Round $round)
    {
        $this->round = $round;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    /**
     * Get round
     *
     * @return Round
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Has event
     *
     * @param Event $event
     * @return boolean
     */
    public function hasEvent(Event $event)
    {
        return $this->events->contains($event);
    }

    /**
     * Add events
     *
     * @param Event $event
     * @return Match
     */
    public function addEvent(Event $event)
    {
        if (!$this->hasEvent($event)) {
            $this->events->add($event);
            $event->setMatch($this);
        }

        return $this;
    }

    /**
     * Remove events
     *
     * @param Event $event
     */
    public function removeEvent(Event $event)
    {
        if ($this->hasEvent($event)) {
            $this->events->removeElement($event);
            $event->removeMatch();
        }
    }

    /**
     * Get goals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Get homeScore
     *
     * @return integer
     */
    public function getHomeScore()
    {
        return $this->homeScore;
    }

    /**
     * Set homeScore
     *
     * @param integer $homeScore
     */
    public function setHomeScore($homeScore)
    {
        $this->homeScore = $homeScore;
    }

    /**
     * Get awayScore
     *
     * @return integer
     */
    public function getAwayScore()
    {
        return $this->awayScore;
    }

    /**
     * Set awayScore
     *
     * @param integer $awayScore
     */
    public function setAwayScore($awayScore)
    {
        $this->awayScore = $awayScore;
    }

    /**
     * Get reported
     *
     * @return \Datetime
     */
    public function getReported()
    {
        return $this->reported;
    }

    /**
     * Set reported
     *
     * @param \Datetime $reported
     */
    public function setReported($reported)
    {
        $this->reported = $reported;
    }

    /**
     * @return bool
     */
    public function isReported()
    {
        return ($this->reported != null);
    }

    /**
     * Set reported to right now
     */
    public function setReportedToNow()
    {
        $this->reported = new \DateTime();
    }

    /**
     * Get confirmed
     *
     * @return \Datetime
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set confirmed
     *
     * @param \Datetime $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return ($this->confirmed != null);
    }

    /**
     * Set confirmed to right now
     */
    public function setConfirmedToNow()
    {
        $this->confirmed = new \DateTime();
    }

    /**
     * @return bool
     */
    public function isSimulated()
    {
        return $this->simulated;
    }

    /**
     * @param bool $simulated
     */
    public function setSimulated(bool $simulated)
    {
        $this->simulated = $simulated;
    }

    /**
     * @return bool
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * @param bool $ranking
     */
    public function setRanking(bool $ranking)
    {
        $this->ranking = $ranking;
    }

    /**
     * Is home
     *
     * @param Competitor $competitor
     * @return boolean
     */
    public function isHome(Competitor $competitor)
    {
        return $this->homeCompetitor == $competitor;
    }

    /**
     * Is away
     *
     * @param Competitor $competitor
     * @return boolean
     */
    public function isAway(Competitor $competitor)
    {
        return $this->awayCompetitor == $competitor;
    }
}