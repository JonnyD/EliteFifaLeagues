<?php

namespace EliteFifa\StandingBundle\DataFixtures\ORM\Competition;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\DataFixtures\ORM\Match\MatchFixtures;
use EliteFifa\SeasonBundle\DataFixtures\ORM\Season\SeasonFixtures;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\StandingBundle\Entity\Standing;
use EliteFifa\StandingBundle\Entity\Table;
use EliteFifa\StandingBundle\Enum\TableType;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StandingFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
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

    }

    private function createStanding(
        Competition $competition,
        Season $season,
        Competitor $competitor,
        $tableType,
        $standingType,
        $played,
        $won,
        $drawn,
        $lost,
        $goalsFor,
        $goalsAgainst,
        $goalDifference,
        $points)
    {
        $standing = new Standing();
        $standing->setCompetition($competition);
        $standing->setSeason($season);
        $standing->setCompetitor($competitor);
        $standing->setTableType($tableType);
        $standing->setStandingType($standingType);
        $standing->setPlayed($played);
        $standing->setWon($won);
        $standing->setDrawn($drawn);
        $standing->setLost($lost);
        $standing->setGoalsFor($goalsFor);
        $standing->setGoalsAgainst($goalsAgainst);
        $standing->setGoalDifference($goalDifference);
        $standing->setPoints($points);
        return $standing;
    }

    /**
     * @param $key
     * @return Table
     */
    private function getTable($key)
    {
        return $this->getReference('table.'.$key);
    }

    /**
     * @param $key
     * @return Competition
     */
    private function getCompetition($key)
    {
        return $this->getReference('competition.'.$key);
    }

    /**
     * @param $key
     * @return Season
     */
    private function getSeason($key)
    {
        return $this->getReference('season.'.$key);
    }

    /**
     * @param $key
     * @return Competitor
     */
    private function getCompetitor($key)
    {
        return $this->getReference('competitor.'.$key);
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
           SeasonFixtures::class
        ];
    }
}