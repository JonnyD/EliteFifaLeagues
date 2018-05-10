<?php

namespace EliteFifa\MatchBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Round
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var ArrayCollection|Match[]
     */
    private $matches;

    /**
     * @var int $round
     */
    private $round;

    /**
     * @var string
     */
    private $name;

    /**
     * @var /DateTime $startDate
     */
    private $startDate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ArrayCollection|Match[]
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * @param ArrayCollection|Match[] $matches
     */
    public function setMatches(array $matches)
    {
        foreach ($matches as $match) {
            $this->addMatch($match);
        }
    }

    /**
     * @param Match $match
     * @return bool
     */
    public function hasMatch(Match $match)
    {
        return $this->matches->contains($match);
    }

    /**
     * @param Match $match
     */
    public function addMatch(Match $match)
    {
        if (!$this->hasMatch($match)) {
            $this->matches->add($match);
        }
    }

    /**
     * @return int
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * @param int $round
     */
    public function setRound($round)
    {
        $this->round = $round;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }
}