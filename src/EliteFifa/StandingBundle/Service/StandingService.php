<?php

namespace EliteFifa\StandingBundle\Service;

use EliteFifa\BaseBundle\Enum\Order;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\StandingBundle\Criteria\StandingCriteria;
use EliteFifa\StandingBundle\Entity\Standing;
use EliteFifa\StandingBundle\Enum\OrderBy;
use EliteFifa\StandingBundle\Enum\StandingType;
use EliteFifa\StandingBundle\Enum\TableType;
use EliteFifa\StandingBundle\Repository\StandingRepository;
use EliteFifa\StandingBundle\VO\Standing as StandingVO;

class StandingService
{
    /**
     * @var StandingRepository
     */
    private $standingRepository;

    /**
     * @param StandingRepository $standingRepository
     */
    public function __construct(StandingRepository $standingRepository)
    {
        $this->standingRepository = $standingRepository;
    }

    /**
     * @param Competition $competition
     * @param Season $season
     * @return Standing[]
     */
    public function getOverallStandingsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        $criteria = new StandingCriteria();
        $criteria->setTableType(TableType::STANDARD);
        $criteria->setStandingType(StandingType::OVERALL);
        $criteria->setCompetition($competition);
        $criteria->setSeason($season);
        $criteria->setSort([
            OrderBy::POINTS => Order::DESC,
            OrderBy::GOAL_DIFFERENCE => Order::DESC,
            OrderBy::WON => Order::DESC
        ]);

        $standings = $this->standingRepository->findStandingsByCriteria($criteria);
        return $standings;
    }

    /**
     * @param Competition $competition
     * @param Season $season
     * @return Standing[]
     */
    public function getHomeStandingsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        $criteria = new StandingCriteria();
        $criteria->setTableType(TableType::STANDARD);
        $criteria->setStandingType(StandingType::HOME);
        $criteria->setCompetition($competition);
        $criteria->setSeason($season);
        $criteria->setSort([
            OrderBy::POINTS => Order::DESC,
            OrderBy::GOAL_DIFFERENCE => Order::DESC,
            OrderBy::WON => Order::DESC
        ]);

        $standings = $this->standingRepository->findStandingsByCriteria($criteria);
        return $standings;
    }

    /**
     * @param Competition $competition
     * @param Season $season
     * @return Standing[]
     */
    public function getAwayStandingsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        $criteria = new StandingCriteria();
        $criteria->setTableType(TableType::STANDARD);
        $criteria->setStandingType(StandingType::AWAY);
        $criteria->setCompetition($competition);
        $criteria->setSeason($season);
        $criteria->setSort([
            OrderBy::POINTS => Order::DESC,
            OrderBy::GOAL_DIFFERENCE => Order::DESC,
            OrderBy::WON => Order::DESC
        ]);

        $standings = $this->standingRepository->findStandingsByCriteria($criteria);
        return $standings;
    }

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
                $standings[$homeCompetitor->getId()] = new StandingVO();
                /** @var StandingVO $standing */
                $standing = $standings[$homeCompetitor->getId()];
                $standing->setCompetitor($homeCompetitor);
            }

            if (!array_key_exists($awayCompetitor->getId(), $standings)) {
                $standings[$awayCompetitor->getId()] = new StandingVO();
                /** @var StandingVO $standing */
                $standing = $standings[$awayCompetitor->getId()];
                $standing->setCompetitor($awayCompetitor);
            }

            /** @var StandingVO $homeStanding */
            $homeStanding = $standings[$homeCompetitor->getId()];
            /** @var StandingVO $awayStanding */
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