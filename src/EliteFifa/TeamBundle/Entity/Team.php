<?php

namespace EliteFifa\TeamBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Entity\Event;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\PlayerBundle\Entity\Player;
use EliteFifa\StadiumBundle\Entity\Stadium;
use EliteFifa\UserBundle\Entity\User;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

class Team
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $slug
     */
    private $slug;

    /**
     * @var string $logo
     */
    private $logo;

    /**
     * @var int $rating
     */
    private $rating;

    /**
     * @var ArrayCollection|Player[]
     */
    protected $players;

    /**
     * @var ArrayCollection|Match[]
     */
    private $homeMatches;

    /**
     * @var ArrayCollection|Match[]
     */
    private $awayMatches;

    /**
     * @var ArrayCollection|Event[]
     */
    private $events;

    /**
     * @var User $user
     */
    private $user;

    /**
     * @var Stadium $stadium
     */
    private $stadium;

    /**
     * @var ArrayCollection|Competitor[]
     */
    private $competitors;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->homeMatches = new ArrayCollection();
        $this->awayMatches = new ArrayCollection();
        $this->goals = new ArrayCollection();
        $this->competitors = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set logo
     *
     * @param string
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set rating
     *
     * @param integer
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Has player
     *
     * @param Player $player
     * @return bool
     */
    public function hasPlayer(Player $player)
    {
        return $this->players->contains($player);
    }

    /**
     * Add players
     *
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        if (!$this->hasPlayer($player)) {
            $this->players->add($player);
            $player->setTeam($this);
        }
    }

    /**
     * Remove players
     *
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        if ($this->hasPlayer($player)) {
            $this->players->removeElement($player);
        }
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Has homeMatch
     *
     * @param Match $homeMatch
     * @return boolean
     */
    public function hasHomeMatch(Match $homeMatch)
    {
        return $this->homeMatches->contains($homeMatch);
    }

    /**
     * Add homeMatch
     *
     * @param Match $homeMatch
     * @return Team
     */
    public function addHomeMatch(Match $homeMatch)
    {
        if (!$this->hasHomeMatch($homeMatch)) {
            $this->homeMatches->add($homeMatch);
            $homeMatch->setHomeTeam($this);
        }

        return $this;
    }

    /**
     * Remove homeMatches
     *
     * @param Match $match
     */
    public function removeHomeMatch(Match $match)
    {
        $match->removeHomeTeam();
        $this->homeMatches->removeElement($match);
    }

    /**
     * Get homeMatches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHomeMatches()
    {
        return $this->homeMatches;
    }

    /**
     * Has awayMatch
     *
     * @param Match $match
     * @return boolean
     */
    public function hasAwayMatch(Match $match)
    {
        return $this->awayMatches->contains($match);
    }

    /**
     * Add awayMatches
     *
     * @param Match $awayMatch
     * @return Team
     */
    public function addAwayMatch(Match $awayMatch)
    {
        if (!$this->hasAwayMatch($awayMatch))
        {
            $this->awayMatches->add($awayMatch);
            $awayMatch->setAwayTeam($this);
        }

        return $this;
    }

    /**
     * Remove awayMatches
     *
     * @param Match $match
     */
    public function removeAwayMatch(Match $match)
    {
        $match->removeAwayTeam();
        $this->awayMatches->removeElement($match);
    }

    /**
     * Get awayMatches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAwayMatches()
    {
        return $this->awayMatches;
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Has event
     *
     * @param Event $event
     * @return boolean
     */
    public function hasGoal(Event $event)
    {
        return $this->events->contains($event);
    }

    /**
     * Add event
     *
     * @param Event $event
     * @return Team
     */
    public function addEvent(Event $event)
    {
        if (!$this->hasEvent($event)) {
            $this->events->add($event);
            $event->setTeam($this);
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
            $event->removeTeam();
            $this->goals->removeElement($event);
        }
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param User user
     */
    public function setUser(User $user)
    {
        if ($this->user == null) {
            $this->user = $user;
            $user->setTeam($this);
        }
    }

    /**
     * Set stadium
     *
     * @param Stadium $stadium
     */
    public function setStadium(Stadium $stadium)
    {
        if ($this->stadium == null) {
            $this->stadium = $stadium;
            $stadium->addTeam($this);
        }
    }

    /**
     * Get stadium
     *
     * @return Stadium
     */
    public function getStadium()
    {
        return $this->stadium;
    }

    /**
     * Remove stadium
     */
    public function removeStadium()
    {
        $this->stadium->removeTeam($this);
        $this->stadium = null;
    }

    /**
     * @return ArrayCollection|Competitor[]
     */
    public function getCompetitors()
    {
        return $this->competitors;
    }

    /**
     * @param $competitors
     */
    public function setCompetitors($competitors)
    {
        $this->competitors = $competitors;
    }
}
