<?php

namespace EliteFifa\StandingBundle\Service;

use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\StandingBundle\VO\Standing;

class StandingService
{
    /**
     * @param Match[] $matches
     * @return Standing[]
     */
    public function getStandingsByMatches($matches)
    {
        $standings = [];

        foreach ($matches as $match) {
            $homeCompetitor = $match->getHomeCompetitor();
            $awayCompetitor = $match->getAwayCompetitor();

            if (!array_key_exists($homeCompetitor->getId(), $standings)) {
                $standings[$homeCompetitor->getId()] = new Standing();
                /** @var Standing $standing */
                $standing = $standings[$homeCompetitor->getId()];
                $standing->setCompetitor($homeCompetitor);
            }

            if (!array_key_exists($awayCompetitor->getId(), $standings)) {
                $standings[$awayCompetitor->getId()] = new Standing();
                /** @var Standing $standing */
                $standing = $standings[$awayCompetitor->getId()];
                $standing->setCompetitor($awayCompetitor);
            }

            /** @var Standing $homeStanding */
            $homeStanding = $standings[$homeCompetitor->getId()];
            /** @var Standing $awayStanding */
            $awayStanding = $standings[$awayCompetitor->getId()];

            $homeStanding->incrementPlayed();
            $homeStanding->incrementHomePlayed();
            $awayStanding->incrementPlayed();
            $awayStanding->incrementAwayPlayed();

            $homeScore = $match->getHomeScore();
            $awayScore = $match->getAwayScore();

            $homeStanding->addGoalsFor($homeScore);
            $homeStanding->addGoalsAgainst($awayScore);
            $homeStanding->updateGoalDifference();

            $homeStanding->addHomeGoalsFor($homeScore);
            $homeStanding->addHomeGoalsAgainst($awayScore);
            $homeStanding->updateHomeGoalsDifference();

            $awayStanding->addGoalsFor($awayScore);
            $awayStanding->addGoalsAgainst($homeScore);
            $awayStanding->updateGoalDifference();

            $awayStanding->addAwayGoalsFor($awayScore);
            $awayStanding->addAwayGoalsAgainst($homeScore);
            $awayStanding->updateAwayGoalsDifference();

            if ($homeScore > $awayScore) {
                $homeStanding->incrementWon();
                $homeStanding->incrementHomeWon();
                $homeStanding->addPoints(3);
                $homeStanding->addHomePoints(3);

                $awayStanding->incrementLost();
                $awayStanding->incrementAwayLost();
            } else if ($homeScore < $awayScore) {
                $homeStanding->incrementLost();
                $homeStanding->incrementHomeLost();

                $awayStanding->incrementWon();
                $awayStanding->incrementAwayWon();
                $awayStanding->addPoints(3);
                $awayStanding->addAwayPoints(3);
            } else {
                $homeStanding->incrementDrawn();
                $homeStanding->incrementHomeDrawn();
                $homeStanding->addPoints(1);
                $homeStanding->addHomePoints(1);

                $awayStanding->incrementDrawn();
                $awayStanding->incrementAwayDrawn();
                $awayStanding->addPoints(1);
                $awayStanding->addAwayPoints(1);
            }
        }

        return array_values($standings);
    }
}