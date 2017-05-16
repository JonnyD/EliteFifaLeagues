<?php

namespace EliteFifa\CompetitionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;

class Stats
{
    /**
     * @var int $id
     */
    private $id;

    /**
     * @var Team $team
     */
    private $team;

    /**
     * @var Competition $competition
     */
    private $competition;

    /**
     * @var Season $season
     */
    private $season;

    /**
     * @var int $played
     */
    private $played = 0;

    /**
     * @var int $won
     */
    private $won = 0;

    /**
     * @var int $drawn
     */
    private $drawn = 0;

    /**
     * @var int $lost
     */
    private $lost = 0;

    /**
     * @var int $yellows
     */
    private $yellows = 0;

    /**
     * @var int $reds
     */
    private $reds = 0;

    /**
     * @var int $scored
     */
    private $scored = 0;

    /**
     * @var int $conceded
     */
    private $conceded = 0;

    /**
     * @var int $points
     */
    private $points = 0;

    /**
     * @var int $currentWinStreak
     */
    private $currentWinStreak = 0;

    /**
     * @var int $highestWinStreak
     */
    private $highestWinStreak = 0;

    /**
     * @var int $currentDrawStreak
     */
    private $currentDrawStreak = 0;

    /**
     * @var int $highestDrawStreak
     */
    private $highestDrawStreak = 0;

    /**
     * @var int $currentLossStreak
     */
    private $currentLossStreak = 0;

    /**
     * @var int $highestLossStreak
     */
    private $highestLossStreak = 0;

    /**
     * @var int $currentWithoutWinningStreak
     */
    private $currentWithoutWinningStreak = 0;

    /**
     * @var int $highestWithoutWinningStreak
     */
    private $highestWithoutWinningStreak = 0;

    /**
     * @var int $currentWithoutLosingStreak
     */
    private $currentWithoutLosingStreak = 0;

    /**
     * @var int $highestWithoutLosingStreak
     */
    private $highestWithoutLosingStreak = 0;

    /**
     * @var int $currentWithoutWinningStreak
     */
    private $currentWithoutConcedingStreak = 0;

    /**
     * @var int $highestWithoutConcedingStreak
     */
    private $highestWithoutConcedingStreak = 0;

    /**
     * @var int $currentWithoutScoringStreak
     */
    private $currentWithoutScoringStreak = 0;

    /**
     * @var int $highestWithoutScoringStreak
     */
    private $highestWithoutScoringStreak = 0;

    /**
     * @var int $currentScoredStreak
     */
    private $currentScoredStreak = 0;

    /**
     * @var int $highestScoredStreak
     */
    private $highestScoredStreak = 0;

    /**
     * @var $currentCombinedForm
     */
    private $currentCombinedForm;

    /**
     * @var int $currentCombinedFormPoints
     */
    private $currentCombinedFormPoints = 0;

    /**
     * @var $currentHomeForm
     */
    private $currentHomeForm;

    /**
     * @var int $currentHomeFormPoints
     */
    private $currentHomeFormPoints = 0;

    /**
     * @var $currentAwayForm
     */
    private $currentAwayForm;

    /**
     * @var int $currentAwayFormPoints
     */
    private $currentAwayFormPoints = 0;

    /**
     * @var $biggestWin
     */
    private $biggestWin;

    /**
     * @var $biggestLoss
     */
    private $biggestLoss;

    /**
     * @var $highestScoringMatch
     */
    private $highestScoringMatch;

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
     * Set team
     *
     * @param Team $team
     */
    public function setTeam(Team $team)
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
     * Set competition
     *
     * @param Competition $competition
     */
    public function setCompetition(Competition $competition)
    {
        $this->competition = $competition;
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
     * Set season
     *
     * @param Season $season
     */
    public function setSeason(Season $season)
    {
        $this->season = $season;
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
     * Set played
     *
     * @param integer $played
     */
    public function setPlayed($played)
    {
        $this->played = $played;
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
     * Set won
     *
     * @param integer $won
     */
    public function setWon($won)
    {
        $this->won = $won;
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
     * Set drawn
     *
     * @param integer $drawn
     */
    public function setDrawn($drawn)
    {
        $this->drawn = $drawn;
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
     * Set lost
     *
     * @param integer $lost
     */
    public function setLost($lost)
    {
        $this->lost = $lost;
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
     * Set yellows
     *
     * @param integer $yellows
     */
    public function setYellows($yellows)
    {
        $this->yellows = $yellows;
    }

    /**
     * Get yellows
     *
     * @return integer
     */
    public function getYellows()
    {
        return $this->yellows;
    }

    /**
     * Set reds
     *
     * @param integer $reds
     */
    public function setReds($reds)
    {
        $this->reds = $reds;
    }

    /**
     * Get reds
     *
     * @return integer
     */
    public function getReds()
    {
        return $this->reds;
    }

    /**
     * Set scored
     *
     * @param integer $scored
     */
    public function setScored($scored)
    {
        $this->scored = $scored;
    }

    /**
     * Get scored
     *
     * @return integer
     */
    public function getScored()
    {
        return $this->scored;
    }

    /**
     * Set conceded
     *
     * @param integer $conceded
     */
    public function setConceded($conceded)
    {
        $this->conceded = $conceded;
    }

    /**
     * Get conceded
     *
     * @return integer
     */
    public function getConceded()
    {
        return $this->conceded;
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
     * Get points
     *
     * @return integer
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set currentWinStreak
     *
     * @param integer $currentWinStreak
     */
    public function setCurrentWinStreak($currentWinStreak)
    {
        $this->currentWinStreak = $currentWinStreak;
    }

    /**
     * Get currentWinStreak
     *
     * @return integer
     */
    public function getCurrentWinStreak()
    {
        return $this->currentWinStreak;
    }

    /**
     * Set highestWinStreak
     *
     * @param integer $highestWinStreak
     */
    public function setHighestWinStreak($highestWinStreak)
    {
        $this->highestWinStreak = $highestWinStreak;
    }

    /**
     * Get highestWinStreak
     *
     * @return integer
     */
    public function getHighestWinStreak()
    {
        return $this->highestWinStreak;
    }

    /**
     * Set currentDrawStreak
     *
     * @param integer $currentDrawStreak
     */
    public function setCurrentDrawStreak($currentDrawStreak)
    {
        $this->currentDrawStreak = $currentDrawStreak;
    }

    /**
     * Get currentDrawStreak
     *
     * @return integer
     */
    public function getCurrentDrawStreak()
    {
        return $this->currentDrawStreak;
    }

    /**
     * Set highestDrawStreak
     *
     * @param integer $highestDrawStreak
     */
    public function setHighestDrawStreak($highestDrawStreak)
    {
        $this->highestDrawStreak = $highestDrawStreak;
    }

    /**
     * Get highestDrawStreak
     *
     * @return integer
     */
    public function getHighestDrawStreak()
    {
        return $this->highestDrawStreak;
    }

    /**
     * Set currentLossStreak
     *
     * @param integer $currentLossStreak
     */
    public function setCurrentLossStreak($currentLossStreak)
    {
        $this->currentLossStreak = $currentLossStreak;
    }

    /**
     * Get currentLossStreak
     *
     * @return integer
     */
    public function getCurrentLossStreak()
    {
        return $this->currentLossStreak;
    }

    /**
     * Set highestLossStreak
     *
     * @param integer $highestLossStreak
     */
    public function setHighestLossStreak($highestLossStreak)
    {
        $this->highestLossStreak = $highestLossStreak;
    }

    /**
     * Get highestLossStreak
     *
     * @return integer
     */
    public function getHighestLossStreak()
    {
        return $this->highestLossStreak;
    }

    /**
     * Set currentWithoutWinningStreak
     *
     * @param integer $currentWithoutWinningStreak
     */
    public function setCurrentWithoutWinningStreak($currentWithoutWinningStreak)
    {
        $this->currentWithoutWinningStreak = $currentWithoutWinningStreak;
    }

    /**
     * Get currentWithoutWinningStreak
     *
     * @return integer
     */
    public function getCurrentWithoutWinningStreak()
    {
        return $this->currentWithoutWinningStreak;
    }

    /**
     * Set currentWithoutLosingStreak
     *
     * @param integer $currentWithoutLosingStreak
     */
    public function setCurrentWithoutLosingStreak($currentWithoutLosingStreak)
    {
        $this->currentWithoutLosingStreak = $currentWithoutLosingStreak;
    }

    /**
     * Get currentWithoutLosingStreak
     *
     * @return integer
     */
    public function getCurrentWithoutLosingStreak()
    {
        return $this->currentWithoutLosingStreak;
    }

    /**
     * Set currentWithoutConcedingStreak
     *
     * @param integer currentWithoutConcedingStreak
     */
    public function setCurrentWithoutConcedingStreak($currentWithoutConcedingStreak)
    {
        $this->currentWithoutConcedingStreak = $currentWithoutConcedingStreak;
    }

    /**
     * Get currentWithoutConcedingStreak
     *
     * @return integer
     */
    public function getCurrentWithoutConcedingStreak()
    {
        return $this->currentWithoutConcedingStreak;
    }

    /**
     * Set currentWithoutScoringStreak
     *
     * @param integer currentWithoutScoringStreak
     */
    public function setCurrentWithoutScoringStreak($currentWithoutScoringStreak)
    {
        $this->currentWithoutScoringStreak = $currentWithoutScoringStreak;
    }

    /**
     * Get currentWithoutScoringStreak
     *
     * @return integer
     */
    public function getCurrentWithoutScoringStreak()
    {
        return $this->currentWithoutScoringStreak;
    }

    /**
     * Set currentScoredStreak
     *
     * @param integer currentScoredStreak
     */
    public function setCurrentScoredStreak($currentScoredStreak)
    {
        $this->currentScoredStreak = $currentScoredStreak;
    }

    /**
     * Get currentScoredStreak
     *
     * @return integer
     */
    public function getCurrentScoredStreak()
    {
        return $this->currentScoredStreak;
    }

    /**
     * Set combinedForm
     *
     * @param string $combinedForm
     */
    public function setCurrentCombinedForm($combinedForm)
    {
        $this->currentCombinedForm = $combinedForm;
    }

    /**
     * Get combinedForm
     *
     * @return string
     */
    public function getCurrentCombinedForm()
    {
        return $this->currentCombinedForm;
    }

    /**
     * Set currentCombinedFormPoints
     *
     * @param integer $currentCombinedFormPoints
     */
    public function setCurrentCombinedFormPoints($currentCombinedFormPoints)
    {
        $this->currentCombinedFormPoints = $currentCombinedFormPoints;
    }

    /**
     * Get currentCombinedFormPoints
     *
     * @return integer
     */
    public function getCurrentCombinedFormPoints()
    {
        return $this->currentCombinedFormPoints;
    }

    /**
     * Set homeForm
     *
     * @param string $homeForm
     */
    public function setCurrentHomeForm($homeForm)
    {
        $this->currentHomeForm = $homeForm;
    }

    /**
     * Get homeForm
     *
     * @return string
     */
    public function getCurrentHomeForm()
    {
        return $this->currentHomeForm;
    }

    /**
     * Set currentHomeFormPoints
     *
     * @param integer $currentHomeFormPoints
     */
    public function setCurrentHomeFormPoints($currentHomeFormPoints)
    {
        $this->currentHomeFormPoints = $currentHomeFormPoints;
    }

    /**
     * Get currentHomeFormPoints
     *
     * @return integer
     */
    public function getCurrentHomeFormPoints()
    {
        return $this->currentHomeFormPoints;
    }

    /**
     * Set awayForm
     *
     * @param string $awayForm
     */
    public function setCurrentAwayForm($awayForm)
    {
        $this->currentAwayForm = $awayForm;
    }

    /**
     * Get awayForm
     *
     * @return string
     */
    public function getCurrentAwayForm()
    {
        return $this->currentAwayForm;
    }

    /**
     * Set currentAwayFormPoints
     *
     * @param integer $currentAwayFormPoints
     */
    public function setCurrentAwayFormPoints($currentAwayFormPoints)
    {
        $this->currentAwayFormPoints = $currentAwayFormPoints;
    }

    /**
     * Get currentAwayFormPoints
     *
     * @return integer
     */
    public function getCurrentAwayFormPoints()
    {
        return $this->currentAwayFormPoints;
    }

    /**
     * Set biggestWin
     *
     * @param Match $match
     */
    public function setBiggestWin(Match $match)
    {
        $this->biggestWin = $match;
    }

    /**
     * Get biggestWin
     *
     * @return Match
     */
    public function getBiggestWin()
    {
        return $this->biggestWin;
    }

    /**
     * Set biggestLoss
     *
     * @param Match $match
     */
    public function setBiggestLoss(Match $match)
    {
        $this->biggestLoss = $match;
    }

    /**
     * Get biggestLoss
     *
     * @return Match
     */
    public function getBiggestLoss()
    {
        return $this->biggestLoss;
    }

    /**
     * Set highestScoringMatch
     *
     * @param Match $match
     */
    public function setHighestScoringMatch(Match $match)
    {
        $this->highestScoringMatch = $match;
    }

    /**
     * Get highestScoringMatch
     *
     * @return Match
     */
    public function getHighestScoringMatch()
    {
        return $this->highestScoringMatch;
    }

    /**
     * Set highestWithoutWinningStreak
     *
     * @param integer $highestWithoutWinningStreak
     */
    public function setHighestWithoutWinningStreak($highestWithoutWinningStreak)
    {
        $this->highestWithoutWinningStreak = $highestWithoutWinningStreak;
    }

    /**
     * Get highestWithoutWinningStreak
     *
     * @return integer $highestWithoutWinningStreak
     */
    public function getHighestWithoutWinningStreak()
    {
        return $this->highestWithoutWinningStreak;
    }

    /**
     * Set highestWithoutLosingStreak
     *
     * @param integer $highestWithoutLosingStreak
     */
    public function setHighestWithoutLosingStreak($highestWithoutLosingStreak)
    {
        $this->highestWithoutLosingStreak = $highestWithoutLosingStreak;
    }

    /**
     * Get highestWithoutLosingStreak
     *
     * @return integer $highestWithoutLosingStreak
     */
    public function getHighestWithoutLosingStreak()
    {
        return $this->highestWithoutLosingStreak;
    }

    /**
     * Set highestWithoutConcedingStreak
     *
     * @param integer $highestWithoutConcedingStreak
     */
    public function setHighestWithoutConcedingStreak($highestWithoutConcedingStreak)
    {
        $this->highestWithoutConcedingStreak = $highestWithoutConcedingStreak;
    }

    /**
     * Get highestWithoutConcedingStreak
     *
     * @return integer
     */
    public function getHighestWithoutConcedingStreak()
    {
        return $this->highestWithoutConcedingStreak;
    }

    /**
     * Set highestWithoutScoringStreak
     *
     * @param integer $highestWithoutScoringStreak
     */
    public function setHighestWithoutScoringStreak($highestWithoutScoringStreak)
    {
        $this->highestWithoutScoringStreak = $highestWithoutScoringStreak;
    }

    /**
     * Get highgestWithoutScoringStreak
     *
     * @return integer
     */
    public function getHighestWithoutScoringStreak()
    {
        return $this->highestWithoutScoringStreak;
    }

    /**
     * Set highestScoredStreak
     *
     * @param integer $highestScoredStreak
     */
    public function setHighestScoredStreak($highestScoredStreak)
    {
        $this->highestScoredStreak = $highestScoredStreak;
    }

    /**
     * Get highestScoredStreak
     *
     * @return integer
     */
    public function getHighestScoredStreak()
    {
        return $this->highestScoredStreak;
    }
}