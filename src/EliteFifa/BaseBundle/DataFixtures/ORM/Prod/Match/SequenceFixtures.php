<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Match;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competition\CompetitionFixtures;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competitor\CompetitorFixtures;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Season\SeasonFixtures;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Service\CompetitorService;
use EliteFifa\MatchBundle\Service\SequenceService;
use EliteFifa\SeasonBundle\Entity\Season;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SequenceFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
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

        $this->createEliteLeague1Season1OverallSequences($manager);
        $this->createEliteLeague1Season1HomeSequences($manager);
        $this->createEliteLeague1Season1AwaySequences($manager);
        $this->createEliteLeague2Season1OverallSequences($manager);
        $this->createEliteLeague2Season1HomeSequences($manager);
        $this->createEliteLeague2Season1AwaySequences($manager);

        $this->createSuperLeague1Season1OverallSequences($manager);
        $this->createSuperLeague1Season1HomeSequences($manager);
        $this->createSuperLeague1Season1AwaySequences($manager);
        $this->createSuperLeague2Season1OverallSequences($manager);
        $this->createSuperLeague2Season1HomeSequences($manager);
        $this->createSuperLeague2Season1AwaySequences($manager);

        $this->createPremierLeague1Season1OverallSequences($manager);
        $this->createPremierLeague1Season1HomeSequences($manager);
        $this->createPremierLeague1Season1AwaySequences($manager);
        $this->createPremierLeague2Season1OverallSequences($manager);
        $this->createPremierLeague2Season1HomeSequences($manager);
        $this->createPremierLeague2Season1AwaySequences($manager);

        $this->createUltraLeague1Season1OverallSequences($manager);
        $this->createUltraLeague1Season1HomeSequences($manager);
        $this->createUltraLeague1Season1AwaySequences($manager);
        $this->createUltraLeague2Season1OverallSequences($manager);
        $this->createUltraLeague2Season1HomeSequences($manager);
        $this->createUltraLeague2Season1AwaySequences($manager);
    }

    private function createEliteLeague1Season1OverallSequences(ObjectManager $manager)
    {
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createOverallSequencesForCompetitors($competitors, $eliteLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createEliteLeague1Season1HomeSequences(ObjectManager $manager)
    {
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createHomeSequencesForCompetitors($competitors, $eliteLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createEliteLeague1Season1AwaySequences(ObjectManager $manager)
    {
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createAwaySequencesForCompetitors($competitors, $eliteLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createEliteLeague2Season1OverallSequences(ObjectManager $manager)
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createOverallSequencesForCompetitors($competitors, $eliteLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createEliteLeague2Season1HomeSequences(ObjectManager $manager)
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createHomeSequencesForCompetitors($competitors, $eliteLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createEliteLeague2Season1AwaySequences(ObjectManager $manager)
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($eliteLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createAwaySequencesForCompetitors($competitors, $eliteLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createSuperLeague1Season1OverallSequences(ObjectManager $manager)
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createOverallSequencesForCompetitors($competitors, $superLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createSuperLeague1Season1HomeSequences(ObjectManager $manager)
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createHomeSequencesForCompetitors($competitors, $superLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createSuperLeague1Season1AwaySequences(ObjectManager $manager)
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createAwaySequencesForCompetitors($competitors, $superLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createSuperLeague2Season1OverallSequences(ObjectManager $manager)
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createOverallSequencesForCompetitors($competitors, $superLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createSuperLeague2Season1HomeSequences(ObjectManager $manager)
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createHomeSequencesForCompetitors($competitors, $superLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createSuperLeague2Season1AwaySequences(ObjectManager $manager)
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($superLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createAwaySequencesForCompetitors($competitors, $superLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createPremierLeague1Season1OverallSequences(ObjectManager $manager)
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createOverallSequencesForCompetitors($competitors, $premierLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createPremierLeague1Season1HomeSequences(ObjectManager $manager)
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createHomeSequencesForCompetitors($competitors, $premierLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createPremierLeague1Season1AwaySequences(ObjectManager $manager)
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createAwaySequencesForCompetitors($competitors, $premierLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createPremierLeague2Season1OverallSequences(ObjectManager $manager)
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createOverallSequencesForCompetitors($competitors, $premierLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createPremierLeague2Season1HomeSequences(ObjectManager $manager)
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createHomeSequencesForCompetitors($competitors, $premierLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createPremierLeague2Season1AwaySequences(ObjectManager $manager)
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($premierLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createAwaySequencesForCompetitors($competitors, $premierLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createUltraLeague1Season1OverallSequences(ObjectManager $manager)
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createOverallSequencesForCompetitors($competitors, $ultraLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createUltraLeague1Season1HomeSequences(ObjectManager $manager)
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createHomeSequencesForCompetitors($competitors, $ultraLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createUltraLeague1Season1AwaySequences(ObjectManager $manager)
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague1, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createAwaySequencesForCompetitors($competitors, $ultraLeague1, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createUltraLeague2Season1OverallSequences(ObjectManager $manager)
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createOverallSequencesForCompetitors($competitors, $ultraLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createUltraLeague2Season1HomeSequences(ObjectManager $manager)
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createHomeSequencesForCompetitors($competitors, $ultraLeague2, $season1);
        $sequenceService->saveAll($sequences);
    }

    private function createUltraLeague2Season1AwaySequences(ObjectManager $manager)
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $season1 = $this->getSeason('season-1');

        $competitorService = $this->getCompetitorService();
        $competitors = $competitorService->getCompetitorsByCompetitionAndSeason($ultraLeague2, $season1);

        $sequenceService = $this->getSequenceService();
        $sequences = $sequenceService->createAwaySequencesForCompetitors($competitors, $ultraLeague2, $season1);
        $sequenceService->saveAll($sequences);
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
     * @return SequenceService
     */
    private function getSequenceService()
    {
        return $this->container->get('elite_fifa.sequence_service');
    }


    public function getDependencies()
    {
        return [
            CompetitorFixtures::class,
            CompetitionFixtures::class,
            SeasonFixtures::class
        ];
    }
}