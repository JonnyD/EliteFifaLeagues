<?php

namespace EliteFifa\CareerBundle\Criteria;

use EliteFifa\UserBundle\Entity\User;

class CareerCriteria
{
    /**
     * @var User
     */
    private $user;

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
    public function setUser($user)
    {
        $this->user = $user;
    }
}