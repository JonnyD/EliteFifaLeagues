<?php

namespace EliteFifa\StandingBundle\DataFixtures\ORM\Competition;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\CompetitionBundle\DataFixtures\ORM\Competition\CompetitionFixtures;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\DataFixtures\ORM\Match\MatchFixtures;
use EliteFifa\SeasonBundle\DataFixtures\ORM\Season\SeasonFixtures;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\StandingBundle\Entity\Standing;
use EliteFifa\StandingBundle\Entity\Table;
use EliteFifa\StandingBundle\Enum\StandingType;
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
        $competitor1 = $this->getCompetitor('competitor1');
        $competitor2 = $this->getCompetitor('competitor2');
        $competitor3 = $this->getCompetitor('competitor3');
        $competitor4 = $this->getCompetitor('competitor4');
        $competitor5 = $this->getCompetitor('competitor5');

        $standing1 = $this->createStanding($eliteLeague1, $season1, $competitor5,
            TableType::STANDARD, StandingType::OVERALL,
            8, 5, 1, 2,
            14, 9, 5, 16);
        $standing2 = $this->createStanding($eliteLeague1, $season1, $competitor4,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            11, 7, 4, 15);
        $standing3 = $this->createStanding($eliteLeague1, $season1, $competitor3,
            TableType::STANDARD, StandingType::OVERALL,
            8, 2, 4, 2,
            16, 17, -1, 10);
        $standing4 = $this->createStanding($eliteLeague1, $season1, $competitor2,
            TableType::STANDARD, StandingType::OVERALL,
            8, 0, 6, 2,
            9, 12, -3, 6);
        $standing5 = $this->createStanding($eliteLeague1, $season1, $competitor1,
            TableType::STANDARD, StandingType::OVERALL,
            8, 0, 6, 2,
            9, 12, -3, 6);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createEliteLeague1Season1HomeStandings(ObjectManager $manager)
    {
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor1 = $this->getCompetitor('competitor1');
        $competitor2 = $this->getCompetitor('competitor2');
        $competitor3 = $this->getCompetitor('competitor3');
        $competitor4 = $this->getCompetitor('competitor4');
        $competitor5 = $this->getCompetitor('competitor5');

        $standing1 = $this->createStanding($eliteLeague1, $season1, $competitor5,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 0, 1,
            7, 3, 4, 9);
        $standing2 = $this->createStanding($eliteLeague1, $season1, $competitor3,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 1, 1,
            7, 6, 1, 7);
        $standing3 = $this->createStanding($eliteLeague1, $season1, $competitor4,
            TableType::STANDARD, StandingType::HOME,
            4, 1, 2, 1,
            6, 6, 0, 5);
        $standing4 = $this->createStanding($eliteLeague1, $season1, $competitor2,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 3, 1,
            6, 7, -1, 3);
        $standing5 = $this->createStanding($eliteLeague1, $season1, $competitor1,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 2, 2,
            4, 6, -2, 2);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createEliteLeague1Season1AwayStandings(ObjectManager $manager)
    {
        $eliteLeague1 = $this->getCompetition('elite-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor1 = $this->getCompetitor('competitor1');
        $competitor2 = $this->getCompetitor('competitor2');
        $competitor3 = $this->getCompetitor('competitor3');
        $competitor4 = $this->getCompetitor('competitor4');
        $competitor5 = $this->getCompetitor('competitor5');

        $standing1 = $this->createStanding($eliteLeague1, $season1, $competitor4,
            TableType::STANDARD, StandingType::AWAY,
            4, 3, 1, 0,
            5, 1, 4, 10);
        $standing2 = $this->createStanding($eliteLeague1, $season1, $competitor5,
            TableType::STANDARD, StandingType::AWAY,
            4, 2, 1, 1,
            7, 6, 1, 7);
        $standing3 = $this->createStanding($eliteLeague1, $season1, $competitor3,
            TableType::STANDARD, StandingType::AWAY,
            4, 0, 3, 1,
            9, 11, -2, 3);
        $standing4 = $this->createStanding($eliteLeague1, $season1, $competitor2,
            TableType::STANDARD, StandingType::AWAY,
            4, 0, 3, 1,
            3, 5, -2, 3);
        $standing5 = $this->createStanding($eliteLeague1, $season1, $competitor1,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 0, 3,
            4, 7, -3, 3);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createEliteLeague2Season1OverallStandings(ObjectManager $manager)
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor6 = $this->getCompetitor('competitor6'); // arsenal
        $competitor7 = $this->getCompetitor('competitor7'); // manchester united
        $competitor8 = $this->getCompetitor('competitor8'); // bayern munich
        $competitor9 = $this->getCompetitor('competitor9'); // milan
        $competitor10 = $this->getCompetitor('competitor10'); // athletico madrid

        $standing1 = $this->createStanding($eliteLeague2, $season1, $competitor10,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            15, 9, 6, 15);
        $standing2 = $this->createStanding($eliteLeague2, $season1, $competitor8,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            18, 13, 5, 15);
        $standing3 = $this->createStanding($eliteLeague2, $season1, $competitor7,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 0, 4,
            16, 14, 2, 12);
        $standing4 = $this->createStanding($eliteLeague2, $season1, $competitor6,
            TableType::STANDARD, StandingType::OVERALL,
            8, 3, 3, 2,
            14, 17, -3, 12);
        $standing5 = $this->createStanding($eliteLeague2, $season1, $competitor9,
            TableType::STANDARD, StandingType::OVERALL,
            8, 0, 1, 7,
            9, 19, -10, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createEliteLeague2Season1HomeStandings(ObjectManager $manager)
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor6 = $this->getCompetitor('competitor6'); // arsenal
        $competitor7 = $this->getCompetitor('competitor7'); // manchester united
        $competitor8 = $this->getCompetitor('competitor8'); // bayern munich
        $competitor9 = $this->getCompetitor('competitor9'); // milan
        $competitor10 = $this->getCompetitor('competitor10'); // athletico madrid

        $standing1 = $this->createStanding($eliteLeague2, $season1, $competitor8,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 1, 0,
            9, 5, 4, 10);
        $standing2 = $this->createStanding($eliteLeague2, $season1, $competitor7,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 0, 1,
            10, 4, 6, 9);
        $standing3 = $this->createStanding($eliteLeague2, $season1, $competitor10,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 2, 0,
            12, 7, 5, 8);
        $standing4 = $this->createStanding($eliteLeague2, $season1, $competitor6,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 1, 1,
            8, 8, 0, 7);
        $standing5 = $this->createStanding($eliteLeague2, $season1, $competitor9,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 1, 3,
            3, 6, -3, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createEliteLeague2Season1AwayStandings(ObjectManager $manager)
    {
        $eliteLeague2 = $this->getCompetition('elite-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor6 = $this->getCompetitor('competitor6'); // arsenal
        $competitor7 = $this->getCompetitor('competitor7'); // manchester united
        $competitor8 = $this->getCompetitor('competitor8'); // bayern munich
        $competitor9 = $this->getCompetitor('competitor9'); // milan
        $competitor10 = $this->getCompetitor('competitor10'); // athletico madrid

        $standing1 = $this->createStanding($eliteLeague2, $season1, $competitor10,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 1, 1,
            3, 2, 1, 7);
        $standing2 = $this->createStanding($eliteLeague2, $season1, $competitor8,
            TableType::STANDARD, StandingType::HOME,
            4, 1, 2, 1,
            9, 8, 1, 5);
        $standing3 = $this->createStanding($eliteLeague2, $season1, $competitor6,
            TableType::STANDARD, StandingType::HOME,
            4, 1, 2, 1,
            6, 9, -3, 5);
        $standing4 = $this->createStanding($eliteLeague2, $season1, $competitor7,
            TableType::STANDARD, StandingType::HOME,
            4, 1, 0, 3,
            6, 10, -4, 3);
        $standing5 = $this->createStanding($eliteLeague2, $season1, $competitor9,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 0, 4,
            6, 13, -7, 0);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createSuperLeague1Season1OverallStandings(ObjectManager $manager)
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor11 = $this->getCompetitor('competitor11'); // tottenham
        $competitor12 = $this->getCompetitor('competitor12'); // roma
        $competitor13 = $this->getCompetitor('competitor13'); // inter
        $competitor14 = $this->getCompetitor('competitor14'); // psg
        $competitor15 = $this->getCompetitor('competitor15'); // juventus

        $standing1 = $this->createStanding($superLeague1, $season1, $competitor15,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            15, 9, 6, 15);
        $standing2 = $this->createStanding($superLeague1, $season1, $competitor13,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            18, 13, 5, 15);
        $standing3 = $this->createStanding($superLeague1, $season1, $competitor12,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 0, 4,
            16, 14, 2, 12);
        $standing4 = $this->createStanding($superLeague1, $season1, $competitor11,
            TableType::STANDARD, StandingType::OVERALL,
            8, 3, 3, 2,
            14, 17, -3, 12);
        $standing5 = $this->createStanding($superLeague1, $season1, $competitor14,
            TableType::STANDARD, StandingType::OVERALL,
            8, 0, 1, 7,
            9, 19, -10, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createSuperLeague1Season1HomeStandings(ObjectManager $manager)
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor11 = $this->getCompetitor('competitor11'); // tottenham
        $competitor12 = $this->getCompetitor('competitor12'); // roma
        $competitor13 = $this->getCompetitor('competitor13'); // inter
        $competitor14 = $this->getCompetitor('competitor14'); // psg
        $competitor15 = $this->getCompetitor('competitor15'); // juventus

        $standing1 = $this->createStanding($superLeague1, $season1, $competitor13,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 1, 0,
            9, 5, 4, 10);
        $standing2 = $this->createStanding($superLeague1, $season1, $competitor12,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 0, 1,
            10, 4, 6, 9);
        $standing3 = $this->createStanding($superLeague1, $season1, $competitor11,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 1, 1,
            8, 8, 0, 7);
        $standing4 = $this->createStanding($superLeague1, $season1, $competitor15,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 2, 0,
            12, 7, 5, 8);
        $standing5 = $this->createStanding($superLeague1, $season1, $competitor14,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 1, 3,
            3, 6, -3, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createSuperLeague1Season1AwayStandings(ObjectManager $manager)
    {
        $superLeague1 = $this->getCompetition('super-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor11 = $this->getCompetitor('competitor11'); // tottenham
        $competitor12 = $this->getCompetitor('competitor12'); // roma
        $competitor13 = $this->getCompetitor('competitor13'); // inter
        $competitor14 = $this->getCompetitor('competitor14'); // psg
        $competitor15 = $this->getCompetitor('competitor15'); // juventus

        $standing1 = $this->createStanding($superLeague1, $season1, $competitor15,
            TableType::STANDARD, StandingType::AWAY,
            4, 2, 1, 1,
            3, 2, 1, 7);
        $standing2 = $this->createStanding($superLeague1, $season1, $competitor13,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            9, 8, 1, 5);
        $standing3 = $this->createStanding($superLeague1, $season1, $competitor11,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            6, 9, -3, 5);
        $standing4 = $this->createStanding($superLeague1, $season1, $competitor12,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 0, 3,
            6, 10, -4, 3);
        $standing5 = $this->createStanding($superLeague1, $season1, $competitor14,
            TableType::STANDARD, StandingType::AWAY,
            4, 0, 0, 4,
            6, 13, -7, 0);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createSuperLeague2Season1OverallStandings(ObjectManager $manager)
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor16 = $this->getCompetitor('competitor16'); // manchester city
        $competitor17 = $this->getCompetitor('competitor17'); // everton
        $competitor18 = $this->getCompetitor('competitor18'); // southampton
        $competitor19 = $this->getCompetitor('competitor19'); // fc schalke
        $competitor20 = $this->getCompetitor('competitor20'); // valencia

        $standing1 = $this->createStanding($superLeague2, $season1, $competitor20,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            15, 9, 6, 15);
        $standing2 = $this->createStanding($superLeague2, $season1, $competitor18,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            18, 13, 5, 15);
        $standing3 = $this->createStanding($superLeague2, $season1, $competitor17,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 0, 4,
            16, 14, 2, 12);
        $standing4 = $this->createStanding($superLeague2, $season1, $competitor16,
            TableType::STANDARD, StandingType::OVERALL,
            8, 3, 3, 2,
            14, 17, -3, 12);
        $standing5 = $this->createStanding($superLeague2, $season1, $competitor19,
            TableType::STANDARD, StandingType::OVERALL,
            8, 0, 1, 7,
            9, 19, -10, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createSuperLeague2Season1HomeStandings(ObjectManager $manager)
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor16 = $this->getCompetitor('competitor16'); // manchester city
        $competitor17 = $this->getCompetitor('competitor17'); // everton
        $competitor18 = $this->getCompetitor('competitor18'); // southampton
        $competitor19 = $this->getCompetitor('competitor19'); // fc schalke
        $competitor20 = $this->getCompetitor('competitor20'); // valencia

        $standing1 = $this->createStanding($superLeague2, $season1, $competitor18,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 1, 0,
            9, 5, 4, 10);
        $standing2 = $this->createStanding($superLeague2, $season1, $competitor17,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 0, 1,
            10, 4, 6, 9);
        $standing3 = $this->createStanding($superLeague2, $season1, $competitor20,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 2, 0,
            12, 7, 5, 8);
        $standing4 = $this->createStanding($superLeague2, $season1, $competitor16,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 1, 1,
            8, 8, 0, 7);
        $standing5 = $this->createStanding($superLeague2, $season1, $competitor19,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 1, 3,
            3, 6, -3, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createSuperLeague2Season1AwayStandings(ObjectManager $manager)
    {
        $superLeague2 = $this->getCompetition('super-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor16 = $this->getCompetitor('competitor16'); // manchester city
        $competitor17 = $this->getCompetitor('competitor17'); // everton
        $competitor18 = $this->getCompetitor('competitor18'); // southampton
        $competitor19 = $this->getCompetitor('competitor19'); // fc schalke
        $competitor20 = $this->getCompetitor('competitor20'); // valencia

        $standing1 = $this->createStanding($superLeague2, $season1, $competitor20,
            TableType::STANDARD, StandingType::AWAY,
            4, 2, 1, 1,
            3, 2, 1, 7);
        $standing2 = $this->createStanding($superLeague2, $season1, $competitor18,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            9, 8, 1, 5);
        $standing3 = $this->createStanding($superLeague2, $season1, $competitor16,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            6, 9, -3, 5);
        $standing4 = $this->createStanding($superLeague2, $season1, $competitor17,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 0, 3,
            6, 10, -4, 3);
        $standing5 = $this->createStanding($superLeague2, $season1, $competitor19,
            TableType::STANDARD, StandingType::AWAY,
            4, 0, 0, 4,
            4, 6, -2, 0);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createPremierLeague1Season1OverallStandings(ObjectManager $manager)
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor21 = $this->getCompetitor('competitor21'); // napoli
        $competitor22 = $this->getCompetitor('competitor22'); // lyon
        $competitor23 = $this->getCompetitor('competitor23'); // as monaco
        $competitor24 = $this->getCompetitor('competitor24'); // sport lisbon
        $competitor25 = $this->getCompetitor('competitor25'); // ajax

        $standing1 = $this->createStanding($premierLeague1, $season1, $competitor25,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            15, 9, 6, 15);
        $standing2 = $this->createStanding($premierLeague1, $season1, $competitor23,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            18, 13, 5, 15);
        $standing3 = $this->createStanding($premierLeague1, $season1, $competitor22,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 0, 4,
            16, 14, 2, 12);
        $standing4 = $this->createStanding($premierLeague1, $season1, $competitor21,
            TableType::STANDARD, StandingType::OVERALL,
            8, 3, 3, 2,
            14, 17, -3, 12);
        $standing5 = $this->createStanding($premierLeague1, $season1, $competitor24,
            TableType::STANDARD, StandingType::OVERALL,
            8, 0, 1, 7,
            9, 19, -10, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createPremierLeague1Season1HomeStandings(ObjectManager $manager)
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor21 = $this->getCompetitor('competitor21'); // napoli
        $competitor22 = $this->getCompetitor('competitor22'); // lyon
        $competitor23 = $this->getCompetitor('competitor23'); // as monaco
        $competitor24 = $this->getCompetitor('competitor24'); // sport lisbon
        $competitor25 = $this->getCompetitor('competitor25'); // ajax

        $standing1 = $this->createStanding($premierLeague1, $season1, $competitor23,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 1, 0,
            9, 5, 4, 10);
        $standing2 = $this->createStanding($premierLeague1, $season1, $competitor22,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 0, 1,
            10, 4, 6, 9);
        $standing3 = $this->createStanding($premierLeague1, $season1, $competitor25,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 2, 0,
            12, 7, 5, 8);
        $standing4 = $this->createStanding($premierLeague1, $season1, $competitor21,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 1, 1,
            8, 8, 0, 7);
        $standing5 = $this->createStanding($premierLeague1, $season1, $competitor24,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 1, 3,
            3, 6, -3, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createPremierLeague1Season1AwayStandings(ObjectManager $manager)
    {
        $premierLeague1 = $this->getCompetition('premier-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor21 = $this->getCompetitor('competitor21'); // napoli
        $competitor22 = $this->getCompetitor('competitor22'); // lyon
        $competitor23 = $this->getCompetitor('competitor23'); // as monaco
        $competitor24 = $this->getCompetitor('competitor24'); // sport lisbon
        $competitor25 = $this->getCompetitor('competitor25'); // ajax

        $standing1 = $this->createStanding($premierLeague1, $season1, $competitor25,
            TableType::STANDARD, StandingType::AWAY,
            4, 2, 1, 1,
            3, 2, 1, 7);
        $standing2 = $this->createStanding($premierLeague1, $season1, $competitor23,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            9, 8, 1, 5);
        $standing3 = $this->createStanding($premierLeague1, $season1, $competitor21,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            6, 9, -3, 5);
        $standing4 = $this->createStanding($premierLeague1, $season1, $competitor22,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 0, 3,
            6, 10, -4, 3);
        $standing5 = $this->createStanding($premierLeague1, $season1, $competitor24,
            TableType::STANDARD, StandingType::AWAY,
            4, 0, 0, 4,
            6, 13, -7, 0);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createPremierLeague2Season1OverallStandings(ObjectManager $manager)
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor26 = $this->getCompetitor('competitor26'); // fc porto
        $competitor27 = $this->getCompetitor('competitor27'); // sunderland
        $competitor28 = $this->getCompetitor('competitor28'); // bayer levekusen
        $competitor29 = $this->getCompetitor('competitor29'); // galatasary
        $competitor30 = $this->getCompetitor('competitor30'); // sporting cp

        $standing1 = $this->createStanding($premierLeague2, $season1, $competitor30,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            18, 13, 5, 15);
        $standing2 = $this->createStanding($premierLeague2, $season1, $competitor28,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            18, 13, 5, 15);
        $standing3 = $this->createStanding($premierLeague2, $season1, $competitor27,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 0, 4,
            16, 14, 2, 12);
        $standing4 = $this->createStanding($premierLeague2, $season1, $competitor26,
            TableType::STANDARD, StandingType::OVERALL,
            8, 3, 3, 2,
            14, 17, -3, 12);
        $standing5 = $this->createStanding($premierLeague2, $season1, $competitor29,
            TableType::STANDARD, StandingType::OVERALL,
            8, 0, 1, 7,
            9, 19, -10, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createPremierLeague2Season1HomeStandings(ObjectManager $manager)
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor26 = $this->getCompetitor('competitor26'); // fc porto
        $competitor27 = $this->getCompetitor('competitor27'); // sunderland
        $competitor28 = $this->getCompetitor('competitor28'); // bayer levekusen
        $competitor29 = $this->getCompetitor('competitor29'); // galatasary
        $competitor30 = $this->getCompetitor('competitor30'); // sporting cp

        $standing1 = $this->createStanding($premierLeague2, $season1, $competitor28,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 1, 0,
            9, 5, 4, 10);
        $standing2 = $this->createStanding($premierLeague2, $season1, $competitor27,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 0, 1,
            10, 4, 6, 9);
        $standing3 = $this->createStanding($premierLeague2, $season1, $competitor30,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 2, 0,
            12, 7, 5, 8);
        $standing4 = $this->createStanding($premierLeague2, $season1, $competitor26,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 1, 1,
            8, 8, 0, 7);
        $standing5 = $this->createStanding($premierLeague2, $season1, $competitor29,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 1, 3,
            3, 6, -3, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createPremierLeague2Season1AwayStandings(ObjectManager $manager)
    {
        $premierLeague2 = $this->getCompetition('premier-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor26 = $this->getCompetitor('competitor26'); // fc porto
        $competitor27 = $this->getCompetitor('competitor27'); // sunderland
        $competitor28 = $this->getCompetitor('competitor28'); // bayer levekusen
        $competitor29 = $this->getCompetitor('competitor29'); // galatasary
        $competitor30 = $this->getCompetitor('competitor30'); // sporting cp

        $standing1 = $this->createStanding($premierLeague2, $season1, $competitor30,
            TableType::STANDARD, StandingType::AWAY,
            4, 2, 1, 1,
            3, 2, 1, 7);
        $standing2 = $this->createStanding($premierLeague2, $season1, $competitor28,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            9, 8, 1, 5);
        $standing3 = $this->createStanding($premierLeague2, $season1, $competitor26,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            6, 9, -3, 5);
        $standing4 = $this->createStanding($premierLeague2, $season1, $competitor27,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 0, 3,
            6, 10, -4, 3);
        $standing5 = $this->createStanding($premierLeague2, $season1, $competitor29,
            TableType::STANDARD, StandingType::AWAY,
            4, 0, 0, 4,
            6, 13, -7, 0);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createUltraLeague1Season1OverallStandings(ObjectManager $manager)
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor31 = $this->getCompetitor('competitor31'); // lazio
        $competitor32 = $this->getCompetitor('competitor32'); // aston villa
        $competitor33 = $this->getCompetitor('competitor33'); // newcastle
        $competitor34 = $this->getCompetitor('competitor34'); // hamburger
        $competitor35 = $this->getCompetitor('competitor35'); // real sociedad

        $standing1 = $this->createStanding($ultraLeague1, $season1, $competitor35,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            15, 9, 6, 15);
        $standing2 = $this->createStanding($ultraLeague1, $season1, $competitor33,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            18, 13, 5, 15);
        $standing3 = $this->createStanding($ultraLeague1, $season1, $competitor32,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 0, 4,
            16, 14, 2, 12);
        $standing4 = $this->createStanding($ultraLeague1, $season1, $competitor31,
            TableType::STANDARD, StandingType::OVERALL,
            8, 3, 3, 2,
            14, 17, -3, 12);
        $standing5 = $this->createStanding($ultraLeague1, $season1, $competitor34,
            TableType::STANDARD, StandingType::OVERALL,
            8, 0, 1, 7,
            9, 19, -10, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createUltraLeague1Season1HomeStandings(ObjectManager $manager)
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor31 = $this->getCompetitor('competitor31'); // lazio
        $competitor32 = $this->getCompetitor('competitor32'); // aston villa
        $competitor33 = $this->getCompetitor('competitor33'); // newcastle
        $competitor34 = $this->getCompetitor('competitor34'); // hamburger
        $competitor35 = $this->getCompetitor('competitor35'); // real sociedad

        $standing1 = $this->createStanding($ultraLeague1, $season1, $competitor33,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 1, 0,
            9, 5, 4, 10);
        $standing2 = $this->createStanding($ultraLeague1, $season1, $competitor32,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 0, 1,
            10, 4, 6, 9);
        $standing3 = $this->createStanding($ultraLeague1, $season1, $competitor35,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 2, 0,
            12, 7, 5, 8);
        $standing4 = $this->createStanding($ultraLeague1, $season1, $competitor31,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 1, 1,
            8, 8, 0, 7);
        $standing5 = $this->createStanding($ultraLeague1, $season1, $competitor34,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 1, 3,
            3, 6, -3, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createUltraLeague1Season1AwayStandings(ObjectManager $manager)
    {
        $ultraLeague1 = $this->getCompetition('ultra-league-1');
        $season1 = $this->getSeason('season-1');
        $competitor31 = $this->getCompetitor('competitor31'); // lazio
        $competitor32 = $this->getCompetitor('competitor32'); // aston villa
        $competitor33 = $this->getCompetitor('competitor33'); // newcastle
        $competitor34 = $this->getCompetitor('competitor34'); // hamburger
        $competitor35 = $this->getCompetitor('competitor35'); // real sociedad

        $standing1 = $this->createStanding($ultraLeague1, $season1, $competitor35,
            TableType::STANDARD, StandingType::AWAY,
            4, 2, 1, 1,
            3, 2, 1, 7);
        $standing2 = $this->createStanding($ultraLeague1, $season1, $competitor33,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            9, 8, 1, 5);
        $standing3 = $this->createStanding($ultraLeague1, $season1, $competitor31,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            6, 9, -3, 5);
        $standing4 = $this->createStanding($ultraLeague1, $season1, $competitor32,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 0, 3,
            6, 10, -4, 3);
        $standing5 = $this->createStanding($ultraLeague1, $season1, $competitor34,
            TableType::STANDARD, StandingType::AWAY,
            4, 0, 0, 4,
            6, 13, -7, 0);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createUltraLeague2Season1OverallStandings(ObjectManager $manager)
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor36 = $this->getCompetitor('competitor36'); // sevilla
        $competitor37 = $this->getCompetitor('competitor37'); // ogc nice
        $competitor38 = $this->getCompetitor('competitor38'); // rb leipzig
        $competitor39 = $this->getCompetitor('competitor39'); // malaga
        $competitor40 = $this->getCompetitor('competitor40'); // leicester city

        $standing1 = $this->createStanding($ultraLeague2, $season1, $competitor40,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            15, 9, 6, 15);
        $standing2 = $this->createStanding($ultraLeague2, $season1, $competitor38,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 3, 1,
            18, 13, 5, 15);
        $standing3 = $this->createStanding($ultraLeague2, $season1, $competitor37,
            TableType::STANDARD, StandingType::OVERALL,
            8, 4, 0, 4,
            16, 14, 2, 12);
        $standing4 = $this->createStanding($ultraLeague2, $season1, $competitor36,
            TableType::STANDARD, StandingType::OVERALL,
            8, 3, 3, 2,
            14, 17, -3, 12);
        $standing5 = $this->createStanding($ultraLeague2, $season1, $competitor39,
            TableType::STANDARD, StandingType::OVERALL,
            8, 0, 1, 7,
            9, 19, -10, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createUltraLeague2Season1HomeStandings(ObjectManager $manager)
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor36 = $this->getCompetitor('competitor36'); // sevilla
        $competitor37 = $this->getCompetitor('competitor37'); // ogc nice
        $competitor38 = $this->getCompetitor('competitor38'); // rb leipzig
        $competitor39 = $this->getCompetitor('competitor39'); // malaga
        $competitor40 = $this->getCompetitor('competitor40'); // leicester city

        $standing1 = $this->createStanding($ultraLeague2, $season1, $competitor38,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 1, 0,
            9, 5, 4, 10);
        $standing2 = $this->createStanding($ultraLeague2, $season1, $competitor37,
            TableType::STANDARD, StandingType::HOME,
            4, 3, 0, 1,
            10, 4, 6, 9);
        $standing3 = $this->createStanding($ultraLeague2, $season1, $competitor40,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 2, 0,
            12, 7, 5, 8);
        $standing4 = $this->createStanding($ultraLeague2, $season1, $competitor36,
            TableType::STANDARD, StandingType::HOME,
            4, 2, 1, 1,
            8, 8, 0, 7);
        $standing5 = $this->createStanding($ultraLeague2, $season1, $competitor39,
            TableType::STANDARD, StandingType::HOME,
            4, 0, 1, 3,
            3, 6, -3, 1);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
    }

    private function createUltraLeague2Season1AwayStandings(ObjectManager $manager)
    {
        $ultraLeague2 = $this->getCompetition('ultra-league-2');
        $season1 = $this->getSeason('season-1');
        $competitor36 = $this->getCompetitor('competitor36'); // sevilla
        $competitor37 = $this->getCompetitor('competitor37'); // ogc nice
        $competitor38 = $this->getCompetitor('competitor38'); // rb leipzig
        $competitor39 = $this->getCompetitor('competitor39'); // malaga
        $competitor40 = $this->getCompetitor('competitor40'); // leicester city

        $standing1 = $this->createStanding($ultraLeague2, $season1, $competitor40,
            TableType::STANDARD, StandingType::AWAY,
            4, 2, 1, 1,
            3, 2, 1, 7);
        $standing2 = $this->createStanding($ultraLeague2, $season1, $competitor38,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            9, 8, 1, 5);
        $standing3 = $this->createStanding($ultraLeague2, $season1, $competitor36,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 2, 1,
            6, 9, -3, 5);
        $standing4 = $this->createStanding($ultraLeague2, $season1, $competitor37,
            TableType::STANDARD, StandingType::AWAY,
            4, 1, 0, 3,
            6, 10, -4, 3);
        $standing5 = $this->createStanding($ultraLeague2, $season1, $competitor39,
            TableType::STANDARD, StandingType::AWAY,
            4, 0, 0, 4,
            6, 13, -7, 0);

        $manager->persist($standing1);
        $manager->persist($standing2);
        $manager->persist($standing3);
        $manager->persist($standing4);
        $manager->persist($standing5);
        $manager->flush();
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
            SeasonFixtures::class,
            CompetitionFixtures::class
        ];
    }
}