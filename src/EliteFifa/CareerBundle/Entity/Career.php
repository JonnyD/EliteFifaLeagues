<?php

namespace EliteFifa\CareerBundle\Entity;

use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\UserBundle\Entity\User;

class Career
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Competitor
     */
    private $competitor;

    /**
     * @var Region
     */
    private $region;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param Region $region
     */
    public function setRegion(Region $region)
    {
        $this->region = $region;
    }
}