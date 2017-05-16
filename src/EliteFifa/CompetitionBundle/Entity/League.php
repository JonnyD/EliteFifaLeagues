<?php

namespace EliteFifa\CompetitionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class League extends Competition
{
    /**
     * @var int
     */
    private $division;

    /**
     * @var int
     */
    private $promotionSpots;

    /**
     * @var int
     */
    private $playoffSpots;

    /**
     * @var int
     */
    private $relegationSpots;

    /**
     * @var League
     */
    private $promotedTo;

    /**
     * @var League
     */
    private $relegatedTo;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get division
     *
     * @return integer
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Set division
     *
     * @param integer $division
     */
    public function setDivision($division)
    {
        $this->division = $division;
    }

    /**
     * Get promotionSpots
     *
     * @return integer
     */
    public function getPromotionSpots()
    {
        return $this->promotionSpots;
    }

    /**
     * Set promotionSpots
     *
     * @param integer $promotionSpots
     */
    public function setPromotionSpots($promotionSpots)
    {
        $this->promotionSpots = $promotionSpots;
    }

    /**
     * Get playoffSpots
     *
     * @return integer
     */
    public function getPlayoffSpots()
    {
        return $this->playoffSpots;
    }

    /**
     * Set playoffSpots
     *
     * @param integer $playoffSpots
     */
    public function setPlayoffSpots($playoffSpots)
    {
        $this->playoffSpots = $playoffSpots;
    }

    /**
     * Get relegationSpots
     *
     * @return integer
     */
    public function getRelegationSpots()
    {
        return $this->relegationSpots;
    }

    /**
     * Set relegationSpots
     *
     * @param integer $relegationSpots
     */
    public function setRelegationSpots($relegationSpots)
    {
        $this->relegationSpots = $relegationSpots;
    }

    /**
     * @return League
     */
    public function getPromotedTo()
    {
        return $this->promotedTo;
    }

    /**
     * @param League $promotedTo
     */
    public function setPromotedTo(League $promotedTo)
    {
        $this->promotedTo = $promotedTo;
    }

    /**
     * @return League
     */
    public function getRelegatedTo()
    {
        return $this->relegatedTo;
    }

    /**
     * @param League $relegatedTo
     */
    public function setRelegatedTo(League $relegatedTo)
    {
        $this->relegatedTo = $relegatedTo;
    }
}
