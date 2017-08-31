<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Standing;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competition\CompetitionFixtures;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competitor\CompetitorFixtures;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Season\SeasonFixtures;
use EliteFifa\CompetitorBundle\Service\CompetitorService;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\StandingBundle\Entity\Standing;
use EliteFifa\StandingBundle\Enum\StandingType;
use EliteFifa\StandingBundle\Enum\TableType;
use EliteFifa\StandingBundle\Service\StandingService;
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
        $this->createEliteLeague1Season1OverallStandings($manager);
        $this->createEliteLeague1Season1HomeStandings($manager);
        $this->createEliteLeague1Season1AwayStandings($manager);
        $this->createEliteLeague2Season1OverallStandings($manager);
        $this->createEliteLeague2Season1HomeStandings($manager);
        $this->createEliteLeague2Season1AwayStandings($manager);

        $this->createSuperLeague1Season1OverallStandings($manager);
        $this->createSuperLeague1Season1HomeStandings($manager);
        $this->createSuperLeague1Season1AwayStandings($manager);
        $this->createSuperLeague2Season1OverallStandings($manager);
        $this->createSuperLeague2Season1HomeStandings($manager);
        $this->createSuperLeague2Season1AwayStandings($manager);

        $this->createPremierLeague1Season1OverallStandings($manager);
        $this->createPremierLeague1Season1HomeStandings($manager);
        $this->createPremierLeague1Season1AwayStandings($manager);
        $this->createPremierLeague2Season1OverallStandings($manager);
        $this->createPremierLeague2Season1HomeStandings($manager);
        $this->createPremierLeague2Season1AwayStandings($manager);

        $this->createUltraLeague1Season1OverallStandings($manager);
        $this->createUltraLeague1Season1HomeStandings($manager);
        $this->createUltraLeague1Season1AwayStandings($manager);
        $this->createUltraLeague2Season1OverallStandings($manager);
        $this->createUltraLeague2Season1HomeStandings($manager);
        $this->createUltraLeague2Season1AwayStandings($manager);
    }

    private function createEliteLeague1Season1OverallStandings(ObjectManager $manager)
    {
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createOverallStandingsForCompetitors($competitors, $eliteLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createEliteLeague1Season1HomeStandings(ObjectManager $manager)
    {
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createHomeStandingsForCompetitors($competitors, $eliteLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createEliteLeague1Season1AwayStandings(ObjectManager $manager)
    {
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createAwayStandingsForCompetitors($competitors, $eliteLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createEliteLeague2Season1OverallStandings(ObjectManager $manager)
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createOverallStandingsForCompetitors($competitors, $eliteLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createEliteLeague2Season1HomeStandings(ObjectManager $manager)
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createHomeStandingsForCompetitors($competitors, $eliteLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createEliteLeague2Season1AwayStandings(ObjectManager $manager)
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createAwayStandingsForCompetitors($competitors, $eliteLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createSuperLeague1Season1OverallStandings(ObjectManager $manager)
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createOverallStandingsForCompetitors($competitors, $superLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createSuperLeague1Season1HomeStandings(ObjectManager $manager)
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createHomeStandingsForCompetitors($competitors, $superLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createSuperLeague1Season1AwayStandings(ObjectManager $manager)
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createAwayStandingsForCompetitors($competitors, $superLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createSuperLeague2Season1OverallStandings(ObjectManager $manager)
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createOverallStandingsForCompetitors($competitors, $superLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createSuperLeague2Season1HomeStandings(ObjectManager $manager)
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createHomeStandingsForCompetitors($competitors, $superLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createSuperLeague2Season1AwayStandings(ObjectManager $manager)
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createAwayStandingsForCompetitors($competitors, $superLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createPremierLeague1Season1OverallStandings(ObjectManager $manager)
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createOverallStandingsForCompetitors($competitors, $premierLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createPremierLeague1Season1HomeStandings(ObjectManager $manager)
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createHomeStandingsForCompetitors($competitors, $premierLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createPremierLeague1Season1AwayStandings(ObjectManager $manager)
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createAwayStandingsForCompetitors($competitors, $premierLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createPremierLeague2Season1OverallStandings(ObjectManager $manager)
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createOverallStandingsForCompetitors($competitors, $premierLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createPremierLeague2Season1HomeStandings(ObjectManager $manager)
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createHomeStandingsForCompetitors($competitors, $premierLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createPremierLeague2Season1AwayStandings(ObjectManager $manager)
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createAwayStandingsForCompetitors($competitors, $premierLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createUltraLeague1Season1OverallStandings(ObjectManager $manager)
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createOverallStandingsForCompetitors($competitors, $ultraLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createUltraLeague1Season1HomeStandings(ObjectManager $manager)
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createHomeStandingsForCompetitors($competitors, $ultraLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createUltraLeague1Season1AwayStandings(ObjectManager $manager)
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague1, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createAwayStandingsForCompetitors($competitors, $ultraLeague1, $season1);
        $standingService->saveAll($standings);
    }

    private function createUltraLeague2Season1OverallStandings(ObjectManager $manager)
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createOverallStandingsForCompetitors($competitors, $ultraLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createUltraLeague2Season1HomeStandings(ObjectManager $manager)
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createHomeStandingsForCompetitors($competitors, $ultraLeague2, $season1);
        $standingService->saveAll($standings);
    }

    private function createUltraLeague2Season1AwayStandings(ObjectManager $manager)
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague2, $season1);

        $standingService = $this->getStandingService();
        $standings = $standingService->createAwayStandingsForCompetitors($competitors, $ultraLeague2, $season1);
        $standingService->saveAll($standings);
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
     * @return CompetitorService
     */
    private function getCompetitorService()
    {
        return $this->container->get('elite_fifa.competitor_service');
    }

    /**
     * @return StandingService
     */
    private function getStandingService()
    {
        return $this->container->get('elite_fifa.standing_service');
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
            CompetitionFixtures::class,
            CompetitorFixtures::class
        ];
    }
}