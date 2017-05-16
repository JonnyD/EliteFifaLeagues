<?php

namespace EliteFifa\RegionBundle\DataFixtures\ORM\Region;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use EliteFifa\RegionBundle\Entity\Region;

class RegionFixtures extends AbstractFixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $world = $this->createRegion("World");

        $manager->persist($world);
        $manager->flush();

        $this->addReference('region.World', $world);
    }

    private function createRegion($name)
    {
        $region = new Region();
        $region->setName($name);
        return $region;
    }
}