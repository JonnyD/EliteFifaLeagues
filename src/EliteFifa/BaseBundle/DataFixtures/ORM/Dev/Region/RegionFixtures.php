<?php

namespace EliteFifa\BaseBundle\DataFixtures\ORM\Dev\Region;

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

    /**
     * @param string $name
     * @return Region
     */
    private function createRegion(string $name)
    {
        $region = new Region();
        $region->setName($name);
        return $region;
    }
}