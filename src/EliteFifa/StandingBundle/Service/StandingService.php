<?php

namespace EliteFifa\StandingBundle\Service;

use EliteFifa\BaseBundle\Enum\Order;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitionBundle\Entity\League;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\StandingBundle\Criteria\StandingCriteria;
use EliteFifa\StandingBundle\Entity\Standing;
use EliteFifa\StandingBundle\Enum\OrderBy;
use EliteFifa\StandingBundle\Enum\StandingType;
use EliteFifa\StandingBundle\Enum\TableType;
use EliteFifa\StandingBundle\Repository\StandingRepository;
use EliteFifa\StandingBundle\VO\Rating;
use EliteFifa\StandingBundle\VO\Standing as StandingVO;
use EliteFifa\UserBundle\Entity\User;

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
     * @param $competitors
     * @param Competition $competition
     * @param Season $season
     * @return Standing[]
     */
    public function createOverallStandingsForCompetitors($competitors, Competition $competition, Season $season)
    {
        $standings = [];

        foreach ($competitors as $competitor) {
            $standing = new Standing();
            $standing->setCompetitor($competitor);
            $standing->setCompetition($competition);
            $standing->setSeason($season);
            $standing->setTableType(TableType::STANDARD);
            $standing->setStandingType(StandingType::OVERALL);

            $standings[] = $standing;
        }

        return $standings;
    }

    /**
     * @param $competitors
     * @param Competition $competition
     * @param Season $season
     * @return Standing[]
     */
    public function createHomeStandingsForCompetitors($competitors, Competition $competition, Season $season)
    {
        $standings = [];

        foreach ($competitors as $competitor) {
            $standing = new Standing();
            $standing->setCompetitor($competitor);
            $standing->setCompetition($competition);
            $standing->setSeason($season);
            $standing->setTableType(TableType::STANDARD);
            $standing->setStandingType(StandingType::HOME);

            $standings[] = $standing;
        }

        return $standings;
    }

    /**
     * @param $competitors
     * @param Competition $competition
     * @param Season $season
     * @return Standing[]
     */
    public function createAwayStandingsForCompetitors($competitors, Competition $competition, Season $season)
    {
        $standings = [];

        foreach ($competitors as $competitor) {
            $standing = new Standing();
            $standing->setCompetitor($competitor);
            $standing->setCompetition($competition);
            $standing->setSeason($season);
            $standing->setTableType(TableType::STANDARD);
            $standing->setStandingType(StandingType::AWAY);

            $standings[] = $standing;
        }

        return $standings;
    }

    /**
     * @param User $user
     * @return Standing
     */
    public function createRankingStanding(User $user)
    {
        $standing = new Standing();
        $standing->setUser($user);
        $standing->setTableType(TableType::RANKING);
        $standing->setPoints(1200);

        return $standing;
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
     * @param League $league
     * @param Season $season
     * @return Standing[]
     */
    public function getPromotedStandingsByCompetitionAndSeason(League $league, Season $season)
    {
        $criteria = new StandingCriteria();
        $criteria->setTableType(TableType::STANDARD);
        $criteria->setStandingType(StandingType::OVERALL);
        $criteria->setCompetition($league);
        $criteria->setSeason($season);
        $criteria->setSort([
            OrderBy::POINTS => Order::DESC,
            OrderBy::GOAL_DIFFERENCE => Order::DESC,
            OrderBy::WON => Order::DESC
        ]);
        $criteria->setLimit($competition->getPromotionSpots());

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
            if (!$match->isConfirmed()) {
                continue;
            }

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

    /**
     * @param Match $match
     */
    public function updateStandingsByMatch(Match $match)
    {
        if (!$match->isConfirmed()) {
            return;
        }

        $competition = $match->getCompetition();
        if (!($competition instanceof League)) {
            return;
        }

        $homeScore = $match->getHomeScore();
        $awayScore = $match->getAwayScore();

        $criteria = new StandingCriteria();
        $criteria->setCompetitor($match->getHomeCompetitor());
        $criteria->setCompetition($match->getCompetition());
        $criteria->setSeason($match->getSeason());
        $criteria->setTableType(TableType::STANDARD);
        $criteria->setStandingType(StandingType::OVERALL);
        $homeOverallStanding = $this->standingRepository->findStandingByCriteria($criteria);

        $criteria->setStandingType(StandingType::HOME);
        $homeHomeStanding = $this->standingRepository->findStandingByCriteria($criteria);

        $homeOverallStanding->incrementPlayed();
        $homeOverallStanding->addGoalsFor($homeScore);
        $homeOverallStanding->addGoalsAgainst($awayScore);
        $homeOverallStanding->updateGoalDifference();

        $homeHomeStanding->incrementPlayed();
        $homeHomeStanding->addGoalsFor($homeScore);
        $homeHomeStanding->addGoalsAgainst($awayScore);
        $homeHomeStanding->updateGoalDifference();

        $criteria->setCompetitor($match->getAwayCompetitor());
        $criteria->setStandingType(StandingType::OVERALL);
        $awayOverallStanding = $this->standingRepository->findStandingByCriteria($criteria);

        $criteria->setStandingType(StandingType::AWAY);
        $awayAwayStanding = $this->standingRepository->findStandingByCriteria($criteria);

        $awayOverallStanding->incrementPlayed();
        $awayOverallStanding->addGoalsFor($awayScore);
        $awayOverallStanding->addGoalsAgainst($homeScore);
        $awayOverallStanding->updateGoalDifference();

        $awayAwayStanding->incrementPlayed();
        $awayAwayStanding->addGoalsFor($awayScore);
        $awayAwayStanding->addGoalsAgainst($homeScore);
        $awayAwayStanding->updateGoalDifference();

        if ($homeScore > $awayScore) {
            $homeOverallStanding->incrementWon();
            $homeOverallStanding->addPoints(3);
            $homeHomeStanding->incrementWon();
            $homeHomeStanding->addPoints(3);

            $awayOverallStanding->incrementLost();
            $awayAwayStanding->incrementLost();
        } else if ($awayScore > $homeScore) {
            $homeOverallStanding->incrementLost();
            $homeHomeStanding->incrementLost();

            $awayOverallStanding->incrementWon();
            $awayOverallStanding->addPoints(3);
            $awayAwayStanding->incrementWon();
            $awayAwayStanding->addPoints(3);
        } else {
            $homeOverallStanding->incrementDrawn();
            $homeOverallStanding->addPoints(1);
            $homeHomeStanding->incrementDrawn();
            $homeHomeStanding->addPoints(1);

            $awayOverallStanding->incrementDrawn();
            $awayOverallStanding->addPoints(1);
            $awayAwayStanding->incrementDrawn();
            $awayAwayStanding->addPoints(1);
        }

        $this->save($homeOverallStanding);
        $this->save($homeHomeStanding);
        $this->save($awayOverallStanding);
        $this->save($awayAwayStanding);
    }

    /**
     * @param Match $match
     */
    public function updateRankingsByMatch(Match $match)
    {
        if (!$match->getRanking()) {
            return;
        }

        $criteria = new StandingCriteria();
        $criteria->setTableType(TableType::RANKING);
        $criteria->setUser($match->getHomeUser());

        $homeRanking = $this->standingRepository->findStandingByCriteria($criteria);
        if ($homeRanking == null) {
            $homeRanking = $this->createRankingStanding($match->getHomeUser());
            $this->save($homeRanking);
        }
        $criteria->setUser($match->getAwayUser());

        $awayRanking = $this->standingRepository->findStandingByCriteria($criteria);
        if ($awayRanking == null) {
            $awayRanking = $this->createRankingStanding($match->getAwayUser());
            $this->save($awayRanking);
        }

        $homeScore = $match->getHomeScore();
        $awayScore = $match->getAwayScore();

        $homePoints = $homeRanking->getPoints();
        $awayPoints = $awayRanking->getPoints();

        if ($homeScore > $awayScore) {
            $rating = new Rating($homePoints, $awayPoints, Rating::WIN, Rating::LOST);
        } else if ($awayScore > $homeScore) {
            $rating = new Rating($homePoints, $awayPoints, Rating::LOST, Rating::WIN);
        } else {
            $rating = new Rating($homePoints, $awayPoints, Rating::DRAW, Rating::DRAW);
        }

        $results = $rating->getNewRatings();
        $homeRanking->setPoints($results['a']);
        $awayRanking->setPoints($results['b']);

        $this->save($homeRanking);
        $this->save($awayRanking);
    }

    /**
     * @param Standing $standing
     * @param bool $sync
     */
    public function save(Standing $standing, bool $sync = true)
    {
        $this->standingRepository->save($standing, $sync);
    }

    /**
     * @param Standing[] $standings
     */
    public function saveAll(array $standings)
    {
        foreach ($standings as $standing) {
            $this->standingRepository->save($standing, false);
        }
        $this->standingRepository->flush();
    }
}