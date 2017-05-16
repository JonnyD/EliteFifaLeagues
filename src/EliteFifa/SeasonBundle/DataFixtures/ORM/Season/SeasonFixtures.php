<?php

namespace EliteFifa\SeasonBundle\DataFixtures\ORM\Season;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\AssociationBundle\DataFixtures\ORM\Association\AssociationFixtures;
use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\CompetitionBundle\DataFixtures\ORM\Competition\CompetitionFixtures;
use EliteFifa\RegionBundle\DataFixtures\ORM\Region\RegionFixtures;
use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\SeasonBundle\Enum\SeasonStatus;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SeasonFixtures extends AbstractFixture implements DependentFixtureInterface, ContainerAwareInterface
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
        $worldRegion = $this->getReference('region.World');

        $eliteSeason1 = $this->createSeason(
            1,
            $worldRegion,
            new \DateTime("2014-01-01"),
            new \DateTime("2014-02-20"),
            SeasonStatus::IN_PROGRESS);

        $manager->persist($eliteSeason1);

        $manager->flush();

        $this->addReference('season.season-1', $eliteSeason1);
    }

    /**
     * @param Region $region
     * @param $startDate
     * @param $endDate
     * @return Season
     */
    private function createSeason($number, Region $region, $startDate, $endDate, $status)
    {
        $season = new Season();
        $season->setNumber($number);
        $season->setRegion($region);
        $season->setStartDate($startDate);
        $season->setEndDate($endDate);
        $season->setStatus($status);
        return $season;
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            RegionFixtures::class
        ];
    }
}