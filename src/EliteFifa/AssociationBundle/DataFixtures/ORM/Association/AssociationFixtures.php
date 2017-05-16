<?php

namespace EliteFifa\AssociationBundle\DataFixtures\ORM\Association;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\RegionBundle\DataFixtures\ORM\Region\RegionFixtures;
use EliteFifa\RegionBundle\Entity\Region;
use EliteFifa\SeasonBundle\DataFixtures\ORM\Season\SeasonFixtures;
use EliteFifa\SeasonBundle\Entity\Season;

class AssociationFixtures extends AbstractFixture implements DependentFixtureInterface
{
    private $manager;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;

        $worldRegion = $this->getRegion('World');
        $season1 = $this->getSeason('season-1');

        $elite = $this->createAssociation("Elite", $worldRegion);
        $elite->addSeason($season1);

        $super = $this->createAssociation("Super", $worldRegion);
        $super->addSeason($season1);

        $premier = $this->createAssociation("Premier", $worldRegion);
        $premier->addSeason($season1);

        $ultra = $this->createAssociation("Ultra", $worldRegion);
        $ultra->addSeason($season1);

        $manager->persist($elite);
        $manager->persist($super);
        $manager->persist($premier);
        $manager->persist($ultra);
        $manager->flush();

        $this->createReference('elite', $elite);
        $this->createReference('super', $super);
        $this->createReference('premier', $premier);
        $this->createReference('ultra', $ultra);
    }

    /**
     * @param $key
     * @return Region
     */
    private function getRegion($key)
    {
        return $this->getReference('region.'.$key);
    }

    /**
     * @param string $key
     * @return Season
     */
    private function getSeason(string $key)
    {
        return $this->getReference('season.'.$key);
    }

    /**
     * @param $name
     *
     * @return Association
     */
    private function createAssociation(string $name, Region $region)
    {
        $association = new Association();
        $association->setName($name);
        $association->setRegion($region);

        return $association;
    }

    /**
     * @param string $key
     * @param Association $association
     */
    private function createReference(string $key, Association $association)
    {
        $this->addReference('association.'.$key, $association);
    }

    public function getDependencies()
    {
        return [
            RegionFixtures::class,
            SeasonFixtures::class
        ];
    }
}