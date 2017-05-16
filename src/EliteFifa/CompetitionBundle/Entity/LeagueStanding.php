<?php

namespace EliteFifa\CompetitionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\Entity\User;
use EliteFifa\SeasonBundle\Entity\Season;

class LeagueStanding
{
    /**
     * @var int $position
     */
    private $position = 0;

    /**
     * @var int $previousPosition
     */
    private $previousPosition = 0;

    /**
     * @var int $played
     */
    private $played = 0;

    /**
     * @var int $homePlayed
     */
    private $homePlayed = 0;

    /**
     * @var int $awayPlayed
     */
    private $awayPlayed = 0;

    /**
     * @var int $won
     */
    private $won = 0;

    /**
     * @var int $homeWon
     */
    private $homeWon = 0;

    /**
     * @var int $awayWon
     */
    private $awayWon = 0;

    /**
     * @var int $lost
     */
    private $lost = 0;

    /**
     * @var int $homeLost
     */
    private $homeLost = 0;

    /**
     * @var int $awayLost
     */
    private $awayLost = 0;

    /**
     * @var int $drawn
     */
    private $drawn = 0;

    /**
     * @var int $homeDrawn
     */
    private $homeDrawn = 0;

    /**
     * @var int $awayDrawn
     */
    private $awayDrawn = 0;

    /**
     * @var int $goalsFor
     */
    private $goalsFor = 0;

    /**
     * @var int $homeGoalsFor
     */
    private $homeGoalsFor = 0;

    /**
     * @var int $awayGoalsFor
     */
    private $awayGoalsFor = 0;

    /**
     * @var int $goalsAgainst
     */
    private $goalsAgainst = 0;

    /**
     * @var int $homeGoalsAgainst
     */
    private $homeGoalsAgainst = 0;

    /**
     * @var int $awayGoalsAgainst
     */
    private $awayGoalsAgainst = 0;

    /**
     * @var int $goalsDifference
     */
    private $goalDifference = 0;

    /**
     * @var int $homeGoalDifference
     */
    private $homeGoalDifference = 0;

    /**
     * @var int $awayGoalDifference
     */
    private $awayGoalDifference = 0;

    /**
     * @var int $points
     */
    private $points = 0;

    /**
     * @var int $homePoints
     */
    private $homePoints = 0;

    /**
     * @var int $awayPoints
     */
    private $awayPoints = 0;

    /**
     * @var int $pointsPerGame
     */
    private $pointsPerGame = 0;

    /**
     * @var int $cleanSheets
     */
    private $cleanSheets = 0;

    /**
     * @var int $failedToScore
     */
    private $failedToScore = 0;

    /**
     * @var int $bothTeamsScored
     */
    private $bothTeamsScored = 0;

    /**
     * @var Team $team
     */
    private $team;

    /**
     * @var Season $season
     */
    private $season;

    /**
     * @var User $user
     */
    private $user;

    /**
     * Set position
     *
     * @param integer $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set previousPosition
     *
     * @param integer $previousPosition
     */
    public function setPreviousPosition($previousPosition)
    {
        $this->previousPosition = $previousPosition;
    }

    /**
     * Get previousPosition
     *
     * @return integer
     */
    public function getPreviousPosition()
    {
        return $this->previousPosition;
    }

    /**
     * Get direction
     *
     * @return integer
     */
    public function getDirection()
    {
        $direction = "";
        if ($this->position < $this->previousPosition) {
            $direction = "up";
        } else if ($this->position == $this->previousPosition) {
            $direction = "same";
        } else if ($this->position > $this->previousPosition) {
            $direction = "down";
        }
        return $direction;
    }

    /**
     * Get played
     *
     * @return integer 
     */
    public function getPlayed()
    {
        return $this->played;
    }

    /**
     * Set played
     *
     * @param integer $played
     */
    public function setPlayed($played)
    {
        $this->played = $played;
    }

    /**
     * Get home played
     *
     * @return integer
     */
    public function getHomePlayed()
    {
        return $this->homePlayed;
    }

    /**
     * Set home played
     *
     * @param integer $homePlayed
     */
    public function setHomePlayed($homePlayed)
    {
        $this->homePlayed = $homePlayed;
    }

    /**
     * Get away played
     *
     * @return integer
     */
    public function getAwayPlayed()
    {
        return $this->awayPlayed;
    }

    /**
     * Set away played
     *
     * @param integer $awayPlayed
     */
    public function setAwayPlayed($awayPlayed)
    {
        $this->awayPlayed = $awayPlayed;
    }

    /**
     * Get won
     *
     * @return integer 
     */
    public function getWon()
    {
        return $this->won;
    }

    /**
     * Set won
     *
     * @param integer $won
     * @return LeagueStanding
     */
    public function setWon($won)
    {
        $this->won = $won;

        return $this;
    }

    /**
     * Get home won
     *
     * @return integer
     */
    public function getHomeWon()
    {
        return $this->homeWon;
    }

    /**
     * Set home won
     *
     * @param integer $homeWon
     */
    public function setHomeWon($homeWon)
    {
        $this->homeWon = $homeWon;
    }

    /**
     * Get away won
     *
     * @return integer
     */
    public function getAwayWon()
    {
        return $this->awayWon;
    }

    /**
     * Set away won
     *
     * @param integer $awayWon
     */
    public function setAwayWon($awayWon)
    {
        $this->awayWon = $awayWon;
    }

    /**
     * Get lost
     *
     * @return integer 
     */
    public function getLost()
    {
        return $this->lost;
    }

    /**
     * Set lost
     *
     * @param integer $lost
     * @return LeagueStanding
     */
    public function setLost($lost)
    {
        $this->lost = $lost;

        return $this;
    }

    /**
     * Get home lost
     *
     * @return integer
     */
    public function getHomeLost()
    {
        return $this->homeLost;
    }

    /**
     * Set home lost
     *
     * @param integer $homeLost
     */
    public function setHomeLost($homeLost)
    {
        $this->homeLost = $homeLost;
    }

    /**
     * Get away lost
     *
     * @return integer
     */
    public function getAwayLost()
    {
        return $this->awayLost;
    }

    /**
     * Set away lost
     *
     * @param integer $awayLost
     */
    public function setAwayLost($awayLost)
    {
        $this->awayLost = $awayLost;
    }

    /**
     * Get drawn
     *
     * @return integer 
     */
    public function getDrawn()
    {
        return $this->drawn;
    }

    /**
     * Set drawn
     *
     * @param integer $drawn
     */
    public function setDrawn($drawn)
    {
        $this->drawn = $drawn;
    }

    /**
     * Get home drawn
     *
     * @return integer
     */
    public function getHomeDrawn()
    {
        return $this->homeDrawn;
    }

    /**
     * Set home drawn
     *
     * @param integer $homeDrawn
     */
    public function setHomeDrawn($homeDrawn)
    {
        $this->homeDrawn = $homeDrawn;
    }

    /**
     * Get away drawn
     *
     * @return integer
     */
    public function getAwayDrawn()
    {
        return $this->awayDrawn;
    }

    /**
     * Set away drawn
     *
     * @param integer $awayDrawn
     */
    public function setAwayDrawn($awayDrawn)
    {
        $this->awayDrawn = $awayDrawn;
    }

    /**
     * Get goalsFor
     *
     * @return integer 
     */
    public function getGoalsFor()
    {
        return $this->goalsFor;
    }

    /**
     * Set goalsFor
     *
     * @param integer $goalsFor
     */
    public function setGoalsFor($goalsFor)
    {
        $this->goalsFor = $goalsFor;
    }

    /**
     * Get homeGoalsFor
     *
     * @return integer
     */
    public function getHomeGoalsFor()
    {
        return $this->homeGoalsFor;
    }

    /**
     * Set homeGoalsFor
     *
     * @param integer $homeGoalsFor
     */
    public function setHomeGoalsFor($homeGoalsFor)
    {
        $this->homeGoalsFor = $homeGoalsFor;
    }

    /**
     * Get awayGoalsFor
     *
     * @return integer
     */
    public function getAwayGoalsFor()
    {
        return $this->awayGoalsFor;
    }

    /**
     * Set awayGoalsFor
     *
     * @param integer $awayGoalsFor
     */
    public function setAwayGoalsFor($awayGoalsFor)
    {
        $this->awayGoalsFor = $awayGoalsFor;
    }

    /**
     * Get goalsAgainst
     *
     * @return integer 
     */
    public function getGoalsAgainst()
    {
        return $this->goalsAgainst;
    }

    /**
     * Set goalsAgainst
     *
     * @param integer $goalsAgainst
     */
    public function setGoalsAgainst($goalsAgainst)
    {
        $this->goalsAgainst = $goalsAgainst;
    }

    /**
     * Get homeGoalsAgainst
     *
     * @return integer
     */
    public function getHomeGoalsAgainst()
    {
        return $this->homeGoalsAgainst;
    }

    /**
     * Set homeGoalsAgainst
     *
     * @param integer $homeGoalsAgainst
     */
    public function setHomeGoalsAgainst($homeGoalsAgainst)
    {
        $this->homeGoalsAgainst = $homeGoalsAgainst;
    }

    /**
     * Get awayGoalsAgainst
     *
     * @return integer
     */
    public function getAwayGoalsAgainst()
    {
        return $this->awayGoalsAgainst;
    }

    /**
     * Set awayGoalsAgainst
     *
     * @param integer $awayGoalsAgainst
     */
    public function setAwayGoalsAgainst($awayGoalsAgainst)
    {
        $this->awayGoalsAgainst = $awayGoalsAgainst;
    }

    /**
     * Get goalDifference
     *
     * @return integer 
     */
    public function getGoalDifference()
    {
        return $this->goalsFor - $this->goalsAgainst;
    }

    /**
     * Set goalDifference
     *
     * @param integer $goalDifference
     */
    public function setGoalDifference($goalDifference)
    {
        $this->goalDifference = $goalDifference;
    }

    /**
     * Get homeGoalDifference
     *
     * @return integer
     */
    public function getHomeGoalDifference()
    {
        return $this->homeGoalDifference;
    }

    /**
     * Set homeGoalDifference
     *
     * @param integer $homeGoalDifference
     */
    public function setHomeGoalDifference($homeGoalDifference)
    {
        $this->homeGoalDifference = $homeGoalDifference;
    }

    /**
     * Get awayGoalDifference
     *
     * @return integer
     */
    public function getAwayGoalDifference()
    {
        return $this->awayGoalDifference;
    }

    /**
     * Set awayGoalDifference
     *
     * @param integer $awayGoalDifference
     */
    public function setAwayGoalDifference($awayGoalDifference)
    {
        $this->awayGoalDifference = $awayGoalDifference;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set points
     *
     * @param integer $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    /**
     * Get homePoints
     *
     * @return integer
     */
    public function getHomePoints()
    {
        return $this->homePoints;
    }

    /**
     * Set homePoints
     *
     * @param integer $homePoints
     */
    public function setHomePoints($homePoints)
    {
        $this->homePoints = $homePoints;
    }

    /**
     * Get awayPoints
     *
     * @return integer
     */
    public function getAwayPoints()
    {
        return $this->awayPoints;
    }

    /**
     * Set awayPoints
     *
     * @param integer $awayPoints
     */
    public function setAwayPoints($awayPoints)
    {
        $this->awayPoints = $awayPoints;
    }

    /**
     * Get pointsPerGame
     *
     * @return integer
     */
    public function getPointsPerGame()
    {
        return $this->pointsPerGame;
    }

    /**
     * Set pointsPerGame
     *
     * @param double $pointsPerGame
     */
    public function setPointsPerGame($pointsPerGame)
    {
        $this->pointsPerGame = $pointsPerGame;
    }

    /**
     * Get cleanSheets
     *
     * @return integer
     */
    public function getCleanSheets()
    {
        return $this->cleanSheets;
    }

    /**
     * Set cleanSheets
     *
     * @param integer $cleanSheets
     */
    public function setCleanSheets($cleanSheets)
    {
        $this->cleanSheets = $cleanSheets;
    }

    /**
     * Get cleanSheetsPercentage
     *
     * @return integer
     */
    public function getCleanSheetsPercentage()
    {
        return 0;
    }

    /**
     * Get failedToScore
     *
     * @return integer
     */
    public function getFailedToScore()
    {
        return $this->failedToScore;
    }

    /**
     * Set failedToScore
     *
     * @param integer $failedToScore
     */
    public function setFailedToScore($failedToScore)
    {
        $this->failedToScore = $failedToScore;
    }

    /**
     * Get bothTeamsScored
     *
     * @return integer
     */
    public function getBothTeamsScored()
    {
        return $this->bothTeamsScored;
    }

    /**
     * Set bothTeamsScored
     *
     * @param integer $bothTeamsScored
     */
    public function setBothTeamsScored($bothTeamsScored)
    {
        $this->bothTeamsScored = $bothTeamsScored;
    }

    /**
     * Set team
     *
     * @param Team $team
     */
    public function setTeam(Team $team = null)
    {
        $this->team = $team;
    }

    /**
     * Get team
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
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
     * Set season
     *
     * @param Season $season
     */
    public function setSeason($season)
    {
        $this->season = $season;
    }

    /**
     * Remove season
     */
    public function removeSeason()
    {
        $this->season = null;
    }

    /**
     * Get User
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
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public static function sortPoints($a, $b)
    {
        $aPoints = $a->getPoints();
        $bPoints = $b->getPoints();

        if ($aPoints < $bPoints) {
            return 1;
        } else if ($aPoints > $bPoints) {
            return -1;
        } else {
            return 0;
        }
    }
}
