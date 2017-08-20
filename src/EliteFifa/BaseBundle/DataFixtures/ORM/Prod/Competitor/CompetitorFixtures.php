<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competitor;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Competition\CompetitionFixtures;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\CompetitorBundle\Enum\CompetitorStatus;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\Season\SeasonFixtures;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\DataFixtures\ORM\Prod\Team\TeamFixtures;
use EliteFifa\BaseBundle\DataFixtures\ORM\Prod\User\UserFixtures;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CompetitorFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
{
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
        $this->createEliteLeague1Competitors($manager);
        $this->createEliteLeague2Competitors($manager);
        $this->createSuperLeague1Competitors($manager);
        $this->createSuperLeague2Competitors($manager);
        $this->createPremierLeague1Competitors($manager);
        $this->createPremierLeague2Competitors($manager);
        $this->createUltraLeague1Competitors($manager);
        $this->createUltraLeague2Competitors($manager);
    }

    private function createEliteLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $eliteLeague1 = $this->getCompetition('elite-league-1');

        $competitor1 = $this->createCompetitor($eliteLeague1, $worldSeason1);
        $competitor2 = $this->createCompetitor($eliteLeague1, $worldSeason1);
        $competitor3 = $this->createCompetitor($eliteLeague1, $worldSeason1);
        $competitor4 = $this->createCompetitor($eliteLeague1, $worldSeason1);
        $competitor5 = $this->createCompetitor($eliteLeague1, $worldSeason1);

        $manager->persist($competitor1);
        $manager->persist($competitor2);
        $manager->persist($competitor3);
        $manager->persist($competitor4);
        $manager->persist($competitor5);
        $manager->flush();

        $this->addCompetitor('competitor1', $competitor1);
        $this->addCompetitor('competitor2', $competitor2);
        $this->addCompetitor('competitor3', $competitor3);
        $this->addCompetitor('competitor4', $competitor4);
        $this->addCompetitor('competitor5', $competitor5);
    }

    private function createEliteLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $eliteLeague2 = $this->getCompetition('elite-league-2');

        $competitor6 = $this->createCompetitor($eliteLeague2, $worldSeason1);
        $competitor7 = $this->createCompetitor($eliteLeague2, $worldSeason1);
        $competitor8 = $this->createCompetitor($eliteLeague2, $worldSeason1);
        $competitor9 = $this->createCompetitor($eliteLeague2, $worldSeason1);
        $competitor10 = $this->createCompetitor($eliteLeague2, $worldSeason1);

        $manager->persist($competitor6);
        $manager->persist($competitor7);
        $manager->persist($competitor8);
        $manager->persist($competitor9);
        $manager->persist($competitor10);
        $manager->flush();

        $this->addCompetitor('competitor6', $competitor6);
        $this->addCompetitor('competitor7', $competitor7);
        $this->addCompetitor('competitor8', $competitor8);
        $this->addCompetitor('competitor9', $competitor9);
        $this->addCompetitor('competitor10', $competitor10);
    }

    private function createSuperLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $superLeague1 = $this->getCompetition('super-league-1');

        $competitor11 = $this->createCompetitor($superLeague1, $worldSeason1);
        $competitor12 = $this->createCompetitor($superLeague1, $worldSeason1);
        $competitor13 = $this->createCompetitor($superLeague1, $worldSeason1);
        $competitor14 = $this->createCompetitor($superLeague1, $worldSeason1);
        $competitor15 = $this->createCompetitor($superLeague1, $worldSeason1);

        $manager->persist($competitor11);
        $manager->persist($competitor12);
        $manager->persist($competitor13);
        $manager->persist($competitor14);
        $manager->persist($competitor15);
        $manager->flush();

        $this->addCompetitor('competitor11', $competitor11);
        $this->addCompetitor('competitor12', $competitor12);
        $this->addCompetitor('competitor13', $competitor13);
        $this->addCompetitor('competitor14', $competitor14);
        $this->addCompetitor('competitor15', $competitor15);
    }

    private function createSuperLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $superLeague2 = $this->getCompetition('super-league-2');

        $competitor16 = $this->createCompetitor($superLeague2, $worldSeason1);
        $competitor17 = $this->createCompetitor($superLeague2, $worldSeason1);
        $competitor18 = $this->createCompetitor($superLeague2, $worldSeason1);
        $competitor19 = $this->createCompetitor($superLeague2, $worldSeason1);
        $competitor20 = $this->createCompetitor($superLeague2, $worldSeason1);

        $manager->persist($competitor16);
        $manager->persist($competitor17);
        $manager->persist($competitor18);
        $manager->persist($competitor19);
        $manager->persist($competitor20);
        $manager->flush();

        $this->addCompetitor('competitor16', $competitor16);
        $this->addCompetitor('competitor17', $competitor17);
        $this->addCompetitor('competitor18', $competitor18);
        $this->addCompetitor('competitor19', $competitor19);
        $this->addCompetitor('competitor20', $competitor20);
    }

    private function createPremierLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $premierLeague1 = $this->getCompetition('premier-league-1');

        $competitor21 = $this->createCompetitor($premierLeague1, $worldSeason1);
        $competitor22 = $this->createCompetitor($premierLeague1, $worldSeason1);
        $competitor23 = $this->createCompetitor($premierLeague1, $worldSeason1);
        $competitor24 = $this->createCompetitor($premierLeague1, $worldSeason1);
        $competitor25 = $this->createCompetitor($premierLeague1, $worldSeason1);

        $manager->persist($competitor21);
        $manager->persist($competitor22);
        $manager->persist($competitor23);
        $manager->persist($competitor24);
        $manager->persist($competitor25);
        $manager->flush();

        $this->addCompetitor('competitor21', $competitor21);
        $this->addCompetitor('competitor22', $competitor22);
        $this->addCompetitor('competitor23', $competitor23);
        $this->addCompetitor('competitor24', $competitor24);
        $this->addCompetitor('competitor25', $competitor25);
    }

    private function createPremierLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $premierLeague2 = $this->getCompetition('premier-league-2');

        $competitor26 = $this->createCompetitor($premierLeague2, $worldSeason1);
        $competitor27 = $this->createCompetitor($premierLeague2, $worldSeason1);
        $competitor28 = $this->createCompetitor($premierLeague2, $worldSeason1);
        $competitor29 = $this->createCompetitor($premierLeague2, $worldSeason1);
        $competitor30 = $this->createCompetitor($premierLeague2, $worldSeason1);

        $manager->persist($competitor26);
        $manager->persist($competitor27);
        $manager->persist($competitor28);
        $manager->persist($competitor29);
        $manager->persist($competitor30);
        $manager->flush();

        $this->addCompetitor('competitor26', $competitor26);
        $this->addCompetitor('competitor27', $competitor27);
        $this->addCompetitor('competitor28', $competitor28);
        $this->addCompetitor('competitor29', $competitor29);
        $this->addCompetitor('competitor30', $competitor30);
    }

    private function createUltraLeague1Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $ultraLeague1 = $this->getCompetition('ultra-league-1');

        $competitor31 = $this->createCompetitor($ultraLeague1, $worldSeason1);
        $competitor32 = $this->createCompetitor($ultraLeague1, $worldSeason1);
        $competitor33 = $this->createCompetitor($ultraLeague1, $worldSeason1);
        $competitor34 = $this->createCompetitor($ultraLeague1, $worldSeason1);
        $competitor35 = $this->createCompetitor($ultraLeague1, $worldSeason1);

        $manager->persist($competitor31);
        $manager->persist($competitor32);
        $manager->persist($competitor33);
        $manager->persist($competitor34);
        $manager->persist($competitor35);
        $manager->flush();

        $this->addCompetitor('competitor31', $competitor31);
        $this->addCompetitor('competitor32', $competitor32);
        $this->addCompetitor('competitor33', $competitor33);
        $this->addCompetitor('competitor34', $competitor34);
        $this->addCompetitor('competitor35', $competitor35);
    }

    private function createUltraLeague2Competitors(ObjectManager $manager)
    {
        $worldSeason1 = $this->getSeason('season-1');
        $ultraLeague2 = $this->getCompetition('ultra-league-2');

        $competitor36 = $this->createCompetitor($ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor37 = $this->createCompetitor($ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor38 = $this->createCompetitor($ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor39 = $this->createCompetitor($ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);
        $competitor40 = $this->createCompetitor($ultraLeague2, $worldSeason1, CompetitorStatus::ENABLED);

        $manager->persist($competitor36);
        $manager->persist($competitor37);
        $manager->persist($competitor38);
        $manager->persist($competitor39);
        $manager->persist($competitor40);
        $manager->flush();

        $this->addCompetitor('competitor36', $competitor36);
        $this->addCompetitor('competitor37', $competitor37);
        $this->addCompetitor('competitor38', $competitor38);
        $this->addCompetitor('competitor39', $competitor39);
        $this->addCompetitor('competitor40', $competitor40);
    }

    /**
     * @param string $slug
     * @return Competition
     */
    private function getCompetition(string $slug)
    {
        return $this->getReference('competition.'.$slug);
    }

    /**
     * @param $key
     * @return Season
     */
    public function getSeason(string $key)
    {
        return $this->getReference('season.'.$key);
    }

    /**
     * @param Competition $competition
     * @param Season $season
     * @return Competitor
     */
    private function createCompetitor(Competition $competition, Season $season)
    {
        $competitor = new Competitor();
        $competitor->addCompetition($competition);
        $competitor->setSeason($season);
        return $competitor;
    }

    /**
     * @param string $key
     * @param Competitor $competitor
     */
    private function addCompetitor(string $key, Competitor $competitor)
    {
        $this->addReference('competitor.'.$key, $competitor);
    }

    /**
     * @return int
     */
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TeamFixtures::class,
            CompetitionFixtures::class,
            SeasonFixtures::class
        ];
    }
}