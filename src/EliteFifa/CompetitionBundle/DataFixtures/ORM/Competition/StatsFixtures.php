<?php

namespace EliteFifa\CompetitionBundle\DataFixtures\ORM\Competition;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StatsFixtures extends AbstractFixture implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /*
        $statsManager = $this->container->get('elite_fifa.stats_manager');
        $resultManager = $this->container->get('elite_fifa.result_manager');
        $participantManager = $this->container->get('elite_fifa.participant_manager');
        $leagueManager = $this->container->get('elite_fifa.league_manager');
        $eventManager = $this->container->get('elite_fifa.event_manager');

        $participants = $participantManager->getAllParticipants();
        foreach ($participants as $participant) {
            $team = $participant->getTeam();
            $competition = $participant->getCompetition();
            $season = $participant->getSeason();

            $stats = $statsManager->getOrCreateStats($team, $competition, $season);
            $results = $resultManager->getResultsByTeam($team, $competition, $season);

            $standing = $leagueManager->getStandingForTeam($team, $competition, $season);
            $stats->setPlayed($standing->getPlayed());
            $stats->setScored($standing->getGoalsFor());
            $stats->setConceded($standing->getGoalsAgainst());
            $stats->setWon($standing->getWon());
            $stats->setLost($standing->getLost());
            $stats->setDrawn($standing->getDrawn());
            $stats->setPoints($standing->getPoints());

            $yellows = $eventManager->getYellowAmountForTeamByCompetitionAndSeason($team, $competition, $season);
            $stats->setYellows($yellows);

            $reds = $eventManager->getRedAmountForTeamByCompetitionAndSeason($team, $competition, $season);
            $stats->setReds($reds);

            $highestWinStreak = $statsManager->getHighestWinStreak($results);
            $statsManager->compareAndUpdateHighestWinStreak($highestWinStreak, $stats);

            $highestLoseStreak = $statsManager->getHighestLoseStreak($results);
            $statsManager->compareAndUpdateHighestLoseStreak($highestLoseStreak, $stats);

            $highestDrawStreak = $statsManager->getHighestDrawStreak($results);
            $statsManager->compareAndUpdateHighestDrawStreak($highestDrawStreak, $stats);

            $currentWinStreak = $statsManager->getCurrentWinStreak($results);
            $stats->setCurrentWinStreak($currentWinStreak);

            $currentDrawStreak = $statsManager->getCurrentDrawStreak($results);
            $stats->setCurrentDrawStreak($currentDrawStreak);

            $currentLoseStreak = $statsManager->getCurrentLoseStreak($results);
            $stats->setCurrentLossStreak($currentLoseStreak);

            $currentWithoutWinningStreak = $statsManager->getCurrentWithoutWinningStreak($results);
            $stats->setCurrentWithoutWinningStreak($currentWithoutWinningStreak);

            $currentWithoutLosingStreak = $statsManager->getCurrentWithoutLosingStreak($results);
            $stats->setCurrentWithoutLosingStreak($currentWithoutLosingStreak);

            $currentWithoutConcedingStreak = $statsManager->getCurrentWithoutConcedingStreak($results);
            $stats->setCurrentWithoutConcedingStreak($currentWithoutConcedingStreak);

            $currentWithoutScoringStreak = $statsManager->getCurrentWithoutScoringStreak($results);
            $stats->setCurrentWithoutScoringStreak($currentWithoutScoringStreak);

            $currentScoredStreak = $statsManager->getCurrentScoredStreak($results);
            $stats->setCurrentScoredStreak($currentScoredStreak);

            $currentCombinedForm = $resultManager->getFormByResults($results, 5);
            $combinedFormString = $resultManager->convertFormToString($currentCombinedForm);
            $stats->setCurrentCombinedForm($combinedFormString);
            $combinedPoints = $resultManager->getPointsFromForm($currentCombinedForm);
            $stats->setCurrentCombinedFormPoints($combinedPoints);

            $homeResults = $resultManager->getHomeResultsByTeam($team, $competition, $season);
            $currentHomeForm = $resultManager->getFormByResults($homeResults, 5);
            $homeFormString = $resultManager->convertFormToString($currentHomeForm);
            $stats->setCurrentHomeForm($homeFormString);
            $homePoints = $resultManager->getPointsFromForm($currentHomeForm);
            $stats->setCurrentHomeFormPoints($homePoints);

            $awayResults = $resultManager->getAwayResultsByTeam($team, $competition, $season);
            $currentAwayForm = $resultManager->getFormByResults($awayResults, 5);
            $awayFormString = $resultManager->convertFormToString($currentAwayForm);
            $stats->setCurrentAwayForm($awayFormString);
            $awayPoints = $resultManager->getPointsFromForm($currentAwayForm);
            $stats->setCurrentAwayFormPoints($awayPoints);

            $biggestWin = $resultManager->getBiggestWinByResults($results);
            $stats->setBiggestWin($biggestWin);

            $biggestLoss = $resultManager->getBiggestLossByResults($results);
            $stats->setBiggestLoss($biggestLoss);

            $highestScoring = $resultManager->getHighestScoringMatchByResults($results);
            $stats->setHighestScoringMatch($highestScoring);

            $highestWithoutWinning = $statsManager->getHighestWithoutWinningStreak($results);
            $statsManager->updateHighestWithoutWinningStreak($highestWithoutWinning, $stats);

            $highestWithoutLosing = $statsManager->getHighestWithoutLosingStreak($results);
            $statsManager->updateHighestWithoutLosingStreak($highestWithoutLosing, $stats);

            $highestWithoutConcedingStreak = $statsManager->getHighestWithoutConcedingStreak($results);
            $statsManager->updateHighestWithoutConcedingStreak($highestWithoutConcedingStreak, $stats);

            $highestWithoutScoringStreak = $statsManager->getHighestWithoutScoringStreak($results);
            $statsManager->updateHighestWithoutScoringStreak($highestWithoutScoringStreak, $stats);

            $highestScoredStreak = $statsManager->getHighestScoredStreak($results);
            $statsManager->updateHighestScoredStreak($highestScoredStreak, $stats);

            $statsManager->persist($stats);
        }
        */
    }
}