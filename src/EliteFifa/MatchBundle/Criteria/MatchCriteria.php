<?php

namespace EliteFifa\MatchBundle\Criteria;

use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\Entity\User;

class MatchCriteria
{
    /**
     * @var Competitor
     */
    private $homeCompetitor;

    /**
     * @var Competitor
     */
    private $awayCompetitor;

    /**
     * @var Team
     */
    private $homeTeam;

    /**
     * @var Team
     */
    private $awayTeam;

    /**
     * @var User
     */
    private $homeUser;

    /**
     * @var User
     */
    private $awayUser;

    /**
     * @var Round
     */
    private $round;

    /**
     * @var Season
     */
    private $season;

    /**
     * @var array
     */
    private $sort;

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
     * @return Team
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * @param Team $homeTeam
     */
    public function setHomeTeam(Team $homeTeam)
    {
        $this->homeTeam = $homeTeam;
    }

    /**
     * @return Team
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * @param Team $awayTeam
     */
    public function setAwayTeam(Team $awayTeam)
    {
        $this->awayTeam = $awayTeam;
    }

    /**
     * @return User
     */
    public function getHomeUser()
    {
        return $this->homeUser;
    }

    /**
     * @param User $homeUser
     */
    public function setHomeUser(User $homeUser)
    {
        $this->homeUser = $homeUser;
    }

    /**
     * @return User
     */
    public function getAwayUser()
    {
        return $this->awayUser;
    }

    /**
     * @param User $awayUser
     */
    public function setAwayUser(User $awayUser)
    {
        $this->awayUser = $awayUser;
    }

    /**
     * @return Round
     */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * @param Round $round
     */
    public function setRound(Round $round)
    {
        $this->round = $round;
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
     * @return array
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param array $sort
     */
    public function setSort(array $sort)
    {
        $this->sort = $sort;
    }
}