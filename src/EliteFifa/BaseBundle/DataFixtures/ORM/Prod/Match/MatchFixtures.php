<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Match;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competitor\CompetitorFixtures;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\CompetitorBundle\Service\CompetitorService;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\MatchBundle\Enum\MatchStatus;
use EliteFifa\MatchBundle\Service\MatchService;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\User\UserFixtures;
use EliteFifa\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MatchFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
{
    private $container;
    private $manager;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->createEliteLeague1Season1Matches();
        $this->createEliteLeague2Season1Matches();
        $this->createSuperLeague1Season1Matches();
        $this->createSuperLeague2Season1Matches();
        $this->createPremierLeague1Season1Matches();
        $this->createPremierLeague2Season1Matches();
        $this->createUltraLeague1Season1Matches();
        $this->createUltraLeague2Season1Matches();
    }

    private function createEliteLeague1Season1Matches()
    {
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $worldSeason1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague1, $worldSeason1);

        $matchService = $this->getMatchService();
        $matches = $matchService->createFixtures($competitors, $eliteLeague1, $worldSeason1);
        $matchService->saveAll($matches);
    }

    private function createEliteLeague2Season1Matches()
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $worldSeason1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague2, $worldSeason1);

        $matchService = $this->getMatchService();
        $matches = $matchService->createFixtures($competitors, $eliteLeague2, $worldSeason1);
        $matchService->saveAll($matches);
    }

    private function createSuperLeague1Season1Matches()
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $worldSeason1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague1, $worldSeason1);

        $matchService = $this->getMatchService();
        $matches = $matchService->createFixtures($competitors, $superLeague1, $worldSeason1);
        $matchService->saveAll($matches);
    }

    private function createSuperLeague2Season1Matches()
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $worldSeason1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague2, $worldSeason1);

        $matchService = $this->getMatchService();
        $matches = $matchService->createFixtures($competitors, $superLeague2, $worldSeason1);
        $matchService->saveAll($matches);
    }

    private function createPremierLeague1Season1Matches()
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $worldSeason1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague1, $worldSeason1);

        $matchService = $this->getMatchService();
        $matches = $matchService->createFixtures($competitors, $premierLeague1, $worldSeason1);
        $matchService->saveAll($matches);
    }

    private function createPremierLeague2Season1Matches()
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $worldSeason1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague2, $worldSeason1);

        $matchService = $this->getMatchService();
        $matches = $matchService->createFixtures($competitors, $premierLeague2, $worldSeason1);
        $matchService->saveAll($matches);
    }

    private function createUltraLeague1Season1Matches()
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $worldSeason1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague1, $worldSeason1);

        $matchService = $this->getMatchService();
        $matches = $matchService->createFixtures($competitors, $ultraLeague1, $worldSeason1);
        $matchService->saveAll($matches);
    }

    private function createUltraLeague2Season1Matches()
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $worldSeason1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague2, $worldSeason1);

        $matchService = $this->getMatchService();
        $matches = $matchService->createFixtures($competitors, $ultraLeague2, $worldSeason1);
        $matchService->saveAll($matches);
    }

    /**
     * @param string $key
     * @return Competition
     */
    private function getCompetition($key)
    {
        return $this->getReference('competition.'.$key);
    }

    /**
     * @param string $key
     * @return Season
     */
    private function getSeason($key)
    {
        return $this->getReference('season.'.$key);
    }

    /**
     * @return MatchService
     */
    private function getMatchService()
    {
        return $this->container->get('elite_fifa.match_service');
    }

    /**
     * @return CompetitorService
     */
    private function getCompetitorService()
    {
        return $this->container->get('elite_fifa.competitor_service');
    }

    public function getDependencies()
    {
        return [
            CompetitorFixtures::class,
            UserFixtures::class
        ];
    }
}