<?php

namespace EliteFifa\CareerBundle\Criteria;

use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\UserBundle\Entity\User;

class CareerCriteria
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var Region
     */
    private $region;

    /**
     * @var Competitor
     */
    private $competitor;

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