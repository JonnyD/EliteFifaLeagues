<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Dev\Competition;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\BaseBundle\DataFixtures\ORM\Dev\Association\AssociationFixtures;
use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\CompetitionBundle\Entity\Knockout;
use EliteFifa\CompetitionBundle\Entity\League;
use EliteFifa\BaseBundle\DataFixtures\ORM\Dev\Season\SeasonFixtures;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CompetitionFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
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
        $worldRegion = $this->getReference('region.World');
        $season1 = $this->getReference('season.season-1');

        $eliteAssociation = $this->getReference('association.elite');

        $eliteLeague1 = $this->createLeague("Elite League 1", "EL1", 1, $eliteAssociation,
            0, 0, 2);
        $eliteLeague1->setRegion($worldRegion);
        $eliteLeague1->addSeason($season1);

        $eliteLeague2 = $this->createLeague("Elite League 2", "EL2", 2, $eliteAssociation,
            2, 0, 0);
        $eliteLeague2->setRegion($worldRegion);
        $eliteLeague2->addSeason($season1);

        $eliteLeague1->setRelegatedTo($eliteLeague2);
        $eliteLeague2->setPromotedTo($eliteLeague1);

        $eliteCup = $this->createKnockout('Elite Cup', 'EC', $eliteAssociation);
        $eliteCup->setRegion($worldRegion);
        $eliteCup->addSeason($season1);

        $manager->persist($eliteLeague1);
        $manager->persist($eliteLeague2);
        $manager->persist($eliteCup);
        $manager->flush();

        $this->addReference('competition.elite-league-1', $eliteLeague1);
        $this->addReference('competition.elite-league-2', $eliteLeague2);
        $this->addReference('competition.elite-cup', $eliteCup);

        $superAssociation = $this->getReference('association.super');

        $superLeague1 = $this->createLeague('Super League 1', 'SL1', 1, $superAssociation,
            0, 0, 2);
        $superLeague1->setRegion($worldRegion);
        $superLeague1->addSeason($season1);

        $superLeague2 = $this->createLeague('Super League 2', 'SL2', 2, $superAssociation,
            2, 0, 0);
        $superLeague2->setRegion($worldRegion);
        $superLeague2->addSeason($season1);

        $superLeague1->setRelegatedTo($superLeague2);
        $superLeague2->setPromotedTo($superLeague1);

        $superCup = $this->createKnockout('Super Cup', 'SC', $superAssociation);
        $superCup->setRegion($worldRegion);
        $superCup->addSeason($season1);

        $manager->persist($superLeague1);
        $manager->persist($superLeague2);
        $manager->persist($superCup);
        $manager->flush();

        $this->addReference('competition.super-league-1', $superLeague1);
        $this->addReference('competition.super-league-2', $superLeague2);
        $this->addReference('competition.super-cup', $superCup);

        $premierAssociation = $this->getReference('association.premier');

        $premierLeague1 = $this->createLeague('Premier League 1', 'PL1', 1, $premierAssociation,
            0, 0, 2);
        $premierLeague1->setRegion($worldRegion);
        $premierLeague1->addSeason($season1);

        $premierLeague2 = $this->createLeague('Premier League 2', 'PL2', 2, $premierAssociation,
            2, 0, 0);
        $premierLeague2->setRegion($worldRegion);
        $premierLeague2->addSeason($season1);

        $premierLeague1->setRelegatedTo($premierLeague2);
        $premierLeague2->setPromotedTo($premierLeague1);

        $premierCup = $this->createKnockout('Premier Cup', 'PC', $premierAssociation);
        $premierCup->setRegion($worldRegion);
        $premierCup->addSeason($season1);

        $manager->persist($premierLeague1);
        $manager->persist($premierLeague2);
        $manager->persist($premierCup);
        $manager->flush();

        $this->addReference('competition.premier-league-1', $premierLeague1);
        $this->addReference('competition.premier-league-2', $premierLeague2);
        $this->addReference('competition.premier-cup', $premierCup);

        $ultraAssociation = $this->getReference('association.ultra');

        $ultraLeague1 = $this->createLeague('Ultra League 1', 'UL1', 1, $ultraAssociation,
            0, 0, 2);
        $ultraLeague1->setRegion($worldRegion);
        $ultraLeague1->addSeason($season1);

        $ultraLeague2 = $this->createLeague('Ultra League 2', 'UL2', 2, $ultraAssociation,
            2, 0, 0);
        $ultraLeague2->setRegion($worldRegion);
        $ultraLeague2->addSeason($season1);

        $ultraLeague1->setRelegatedTo($ultraLeague2);
        $ultraLeague2->setPromotedTo($ultraLeague1);

        $ultraCup = $this->createKnockout('Ultra Cup', 'UC', $ultraAssociation);
        $ultraCup->setRegion($worldRegion);
        $ultraCup->addSeason($season1);

        $manager->persist($ultraLeague1);
        $manager->persist($ultraLeague2);
        $manager->persist($ultraCup);
        $manager->flush();

        $this->addReference('competition.ultra-league-1', $ultraLeague1);
        $this->addReference('competition.ultra-league-2', $ultraLeague2);
        $this->addReference('competition.ultra-cup', $ultraCup);
    }

    /**
     * @param string $name
     * @param string $code
     * @param int $division
     * @param Association $association
     * @param int $promotionSpots
     * @param int $playoffSpots
     * @param int $relegationSpots
     * @return League
     */
    private function createLeague(string $name, string $code, int $division, Association $association,
                                  int $promotionSpots, int $playoffSpots, int $relegationSpots)
    {
        $league = new League();
        $league->setName($name);
        $league->setCode($code);
        $league->setDivision($division);
        $league->setAssociation($association);
        $league->setPromotionSpots($promotionSpots);
        $league->setPlayoffSpots($playoffSpots);
        $league->setRelegationSpots($relegationSpots);
        return $league;
    }

    /**
     * @param $name
     * @param $code
     * @param $association
     * @return Knockout
     */
    private function createKnockout($name, $code, $association)
    {
        $knockout = new Knockout();
        $knockout->setName($name);
        $knockout->setCode($code);
        $knockout->setAssociation($association);
        return $knockout;
    }

    /**
     * @return int
     */
    public function getDependencies()
    {
        return [
            AssociationFixtures::class,
            SeasonFixtures::class
        ];
    }
}