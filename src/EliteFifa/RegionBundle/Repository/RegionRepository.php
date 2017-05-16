<?php

namespace EliteFifa\RegionBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\RegionBundle\Entity\Region;

class RegionRepository extends EntityRepository
{
    /**
     * @param Region $region
     * @param bool $sync
     */
    public function save(Region $region, bool $sync = true)
    {
        $this->getEntityManager()->persist($region);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}