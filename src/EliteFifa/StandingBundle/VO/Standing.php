<?php

namespace EliteFifa\StandingBundle\VO;

use EliteFifa\CompetitorBundle\Entity\Competitor;

class Standing
{
    /**
     * @var Competitor
     */
    private $competitor;

    /**
     * @var int
     */
    private $played = 0;

    /**
     * @var int
     */
    private $homePlayed = 0;

    /**
     * @var int
     */
    private $awayPlayed = 0;

    /**
     * @var int
     */
    private $won = 0;

    /**
     * @var int
     */
    private $homeWon = 0;

    /**
     * @var int
     */
    private $awayWon = 0;

    /**
     * @var int
     */
    private $drawn = 0;

    /**
     * @var int
     */
    private $homeDrawn = 0;

    /**
     * @var int
     */
    private $awayDrawn = 0;

    /**
     * @var int
     */
    private $lost = 0;

    /**
     * @var int
     */
    private $homeLost = 0;

    /**
     * @var int
     */
    private $awayLost = 0;

    /**
     * @var int
     */
    private $goalsFor = 0;

    /**
     * @var int
     */
    private $homeGoalsFor = 0;

    /**
     * @var int
     */
    private $awayGoalsFor = 0;

    /**
     * @var int
     */
    private $goalsAgainst = 0;

    /**
     * @var int
     */
    private $homeGoalsAgainst = 0;

    /**
     * @var int
     */
    private $awayGoalsAgainst = 0;

    /**
     * @var int
     */
    private $goalDifference = 0;

    /**
     * @var int
     */
    private $homeGoalDifference = 0;

    /**
     * @var int
     */
    private $awayGoalDifference = 0;

    /**
     * @var int
     */
    private $points = 0;

    /**
     * @var int
     */
    private $homePoints = 0;

    /**
     * @var int
     */
    private $awayPoints = 0;

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
     * @return int
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * @param int $played
     */
    public function setPlayed($played)
    {
        $this->played = $played;
    }

    /**
     * @param int $played
     */
    public function addPlayed($played)
    {
        $this->played = $this->played + $played;
    }

    public function incrementPlayed()
    {
        $this->addPlayed(1);
    }

    /**
     * @return int
     */
    public function getHomePlayed()
    {
        return $this->homePlayed;
    }

    /**
     * @param int $homePlayed
     */
    public function setHomePlayed($homePlayed)
    {
        $this->homePlayed = $homePlayed;
    }

    /**
     * @param int $homePlayed
     */
    public function addHomePlayed($homePlayed)
    {
        $this->homePlayed = $this->homePlayed + $homePlayed;
    }

    public function incrementHomePlayed()
    {
        $this->addHomePlayed(1);
    }

    /**
     * @return int
     */
    public function getAwayPlayed()
    {
        return $this->awayPlayed;
    }

    /**
     * @param int $awayPlayed
     */
    public function setAwayPlayed($awayPlayed)
    {
        $this->awayPlayed = $awayPlayed;
    }

    /**
     * @param int $awayPlayed
     */
    public function addAwayPlayed($awayPlayed)
    {
        $this->awayPlayed = $this->awayPlayed + $awayPlayed;
    }

    public function incrementAwayPlayed()
    {
        $this->addAwayPlayed(1);
    }

    /**
     * @return int
     */
    public function getWon()
    {
        return $this->won;
    }

    /**
     * @param int $won
     */
    public function setWon($won)
    {
        $this->won = $won;
    }

    /**
     * @param int $won
     */
    public function addWon($won)
    {
        $this->won = $this->won + $won;
    }

    public function incrementWon()
    {
        $this->addWon(1);
    }

    /**
     * @return int
     */
    public function getHomeWon()
    {
        return $this->homeWon;
    }

    /**
     * @param int $homeWon
     */
    public function setHomeWon($homeWon)
    {
        $this->homeWon = $homeWon;
    }

    /**
     * @param int $homeWon
     */
    public function addHomeWon($homeWon)
    {
        $this->homeWon = $this->homeWon + $homeWon;
    }

    public function incrementHomeWon()
    {
        $this->addHomeWon(1);
    }

    /**
     * @return int
     */
    public function getAwayWon()
    {
        return $this->awayWon;
    }

    /**
     * @param int $awayWon
     */
    public function setAwayWon($awayWon)
    {
        $this->awayWon = $awayWon;
    }

    /**
     * @param int $awayWon
     */
    public function addAwayWon($awayWon)
    {
        $this->awayWon = $this->awayWon + $awayWon;
    }

    public function incrementAwayWon()
    {
        $this->addAwayWon(1);
    }

    /**
     * @return int
     */
    public function getDrawn()
    {
        return $this->drawn;
    }

    /**
     * @param int $drawn
     */
    public function setDrawn($drawn)
    {
        $this->drawn = $drawn;
    }

    public function incrementDrawn()
    {
        $this->addDrawn(1);
    }

    /**
     * @param int $drawn
     */
    public function addDrawn($drawn)
    {
        $this->drawn = $this->drawn + $drawn;
    }

    /**
     * @return int
     */
    public function getHomeDrawn()
    {
        return $this->homeDrawn;
    }

    /**
     * @param int $homeDrawn
     */
    public function setHomeDrawn($homeDrawn)
    {
        $this->homeDrawn = $homeDrawn;
    }

    /**
     * @param int $homeDrawn
     */
    public function addHomeDrawn($homeDrawn)
    {
        $this->homeDrawn = $this->homeDrawn + $homeDrawn;
    }

    public function incrementHomeDrawn()
    {
        $this->addHomeDrawn(1);
    }

    /**
     * @return int
     */
    public function getAwayDrawn()
    {
        return $this->awayDrawn;
    }

    /**
     * @param int $awayDrawn
     */
    public function setAwayDrawn($awayDrawn)
    {
        $this->awayDrawn = $awayDrawn;
    }

    /**
     * @param int $awayDrawn
     */
    public function addAwayDrawn($awayDrawn)
    {
        $this->awayDrawn = $this->awayDrawn + $awayDrawn;
    }

    public function incrementAwayDrawn()
    {
        $this->addAwayDrawn(1);
    }

    /**
     * @return int
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * @param int $lost
     */
    public function setLost($lost)
    {
        $this->lost = $lost;
    }

    public function incrementLost()
    {
        $this->addLost(1);
    }

    /**
     * @param int $lost
     */
    public function addLost($lost)
    {
        $this->lost = $this->lost + $lost;
    }

    /**
     * @return int
     */
    public function getHomeLost()
    {
        return $this->homeLost;
    }

    /**
     * @param int $homeLost
     */
    public function setHomeLost($homeLost)
    {
        $this->homeLost = $homeLost;
    }

    /**
     * @param int $homeLost
     */
    public function addHomeLost($homeLost)
    {
        $this->homeLost = $this->homeLost + $homeLost;
    }

    public function incrementHomeLost()
    {
        $this->addHomeLost(1);
    }

    /**
     * @return int
     */
    public function getAwayLost()
    {
        return $this->awayLost;
    }

    /**
     * @param int $awayLost
     */
    public function setAwayLost($awayLost)
    {
        $this->awayLost = $awayLost;
    }

    /**
     * @param int $awayLost
     */
    public function addAwayLost($awayLost)
    {
        $this->awayLost = $this->awayLost + $awayLost;
    }

    public function incrementAwayLost()
    {
        $this->addAwayLost(1);
    }

    /**
     * @return int
     */
    public function getGoalsFor()
    {
        return $this->goalsFor;
    }

    /**
     * @param int $goalsFor
     */
    public function setGoalsFor($goalsFor)
    {
        $this->goalsFor = $goalsFor;
    }

    /**
     * @param int $goalsFor
     */
    public function addGoalsFor($goalsFor)
    {
        $this->goalsFor = $this->goalsFor + $goalsFor;
    }

    /**
     * @return int
     */
    public function getHomeGoalsFor()
    {
        return $this->homeGoalsFor;
    }

    /**
     * @param int $homeGoalsFor
     */
    public function setHomeGoalsFor($homeGoalsFor)
    {
        $this->homeGoalsFor = $homeGoalsFor;
    }

    /**
     * @param int $homeGoalsFor
     */
    public function addHomeGoalsFor($homeGoalsFor)
    {
        $this->homeGoalsFor = $this->homeGoalsFor + $homeGoalsFor;
    }

    /**
     * @return int
     */
    public function getAwayGoalsFor()
    {
        return $this->awayGoalsFor;
    }

    /**
     * @param int $awayGoalsFor
     */
    public function setAwayGoalsFor($awayGoalsFor)
    {
        $this->awayGoalsFor = $awayGoalsFor;
    }

    /**
     * @param int $awayGoalsFor
     */
    public function addAwayGoalsFor($awayGoalsFor)
    {
        $this->awayGoalsFor = $this->awayGoalsFor + $awayGoalsFor;
    }

    /**
     * @return int
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * @param int $goalsAgainst
     */
    public function setGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst = $goalsAgainst;
    }

    /**
     * @param int $goalsAgainst
     */
    public function addGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst = $this->goalsAgainst + $goalsAgainst;
    }

    /**
     * @return int
     */
    public function getHomeGoalsAgainst()
    {
        return $this->homeGoalsAgainst;
    }

    /**
     * @param int $homeGoalsAgainst
     */
    public function setHomeGoalsAgainst($homeGoalsAgainst)
    {
        $this->homeGoalsAgainst = $homeGoalsAgainst;
    }

    /**
     * @param int $homeGoalsAgainst
     */
    public function addHomeGoalsAgainst($homeGoalsAgainst)
    {
        $this->homeGoalsAgainst = $this->homeGoalsAgainst + $homeGoalsAgainst;
    }

    public function updateHomeGoalsDifference()
    {
        $this->homeGoalDifference = $this->homeGoalsFor - $this->homeGoalsAgainst;
    }

    /**
     * @return int
     */
    public function getAwayGoalsAgainst()
    {
        return $this->awayGoalsAgainst;
    }

    /**
     * @param int $awayGoalsAgainst
     */
    public function setAwayGoalsAgainst($awayGoalsAgainst)
    {
        $this->awayGoalsAgainst = $awayGoalsAgainst;
    }

    /**
     * @param int $awayGoalsAgainst
     */
    public function addAwayGoalsAgainst($awayGoalsAgainst)
    {
        $this->awayGoalsAgainst = $this->awayGoalsAgainst + $awayGoalsAgainst;
    }

    public function updateAwayGoalsDifference()
    {
        $this->awayGoalDifference = $this->awayGoalsFor - $this->awayGoalsAgainst;
    }

    /**
     * @return int
     */
    public function getGoalDifference()
    {
        return $this->goalDifference;
    }

    /**
     * @param int $goalDifference
     */
    public function setGoalDifference($goalDifference)
    {
        $this->goalDifference = $goalDifference;
    }

    /**
     * @param $goalDifference
     */
    public function addGoalDifference($goalDifference)
    {
        $this->goalDifference = $this->goalDifference + $goalDifference;
    }

    public function updateGoalDifference()
    {
        $this->goalDifference = $this->goalsFor - $this->goalsAgainst;
    }

    /**
     * @return int
     */
    public function getHomeGoalDifference()
    {
        return $this->homeGoalDifference;
    }

    /**
     * @param int $homeGoalDifference
     */
    public function setHomeGoalDifference($homeGoalDifference)
    {
        $this->homeGoalDifference = $homeGoalDifference;
    }

    /**
     * @param int $homeGoalDifference
     */
    public function addHomeGoalDifference($homeGoalDifference)
    {
        $this->homeGoalDifference = $this->homeGoalDifference + $homeGoalDifference;
    }

    /**
     * @return int
     */
    public function getAwayGoalDifference()
    {
        return $this->awayGoalDifference;
    }

    /**
     * @param int $awayGoalDifference
     */
    public function setAwayGoalDifference($awayGoalDifference)
    {
        $this->awayGoalDifference = $awayGoalDifference;
    }

    /**
     * @param int $awayGoalDifference
     */
    public function addAwayGoalDifference($awayGoalDifference)
    {
        $this->awayGoalDifference = $this->awayGoalDifference + $awayGoalDifference;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * @param int $points
     */
    public function addPoints($points)
    {
        $this->points = $this->points + $points;
    }

    /**
     * @return int
     */
    public function getHomePoints()
    {
        return $this->homePoints;
    }

    /**
     * @param int $homePoints
     */
    public function setHomePoints($homePoints)
    {
        $this->homePoints = $homePoints;
    }

    /**
     * @param int $homePoints
     */
    public function addHomePoints($homePoints)
    {
        $this->homePoints = $this->homePoints + $homePoints;
    }

    /**
     * @return int
     */
    public function getAwayPoints()
    {
        return $this->awayPoints;
    }

    /**
     * @param int $awayPoints
     */
    public function setAwayPoints($awayPoints)
    {
        $this->awayPoints = $awayPoints;
    }

    /**
     * @param int $awayPoints
     */
    public function addAwayPoints($awayPoints)
    {
        $this->awayPoints = $this->awayPoints + $awayPoints;
    }
}
