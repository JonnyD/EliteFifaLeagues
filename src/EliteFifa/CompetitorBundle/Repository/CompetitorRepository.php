<?php

namespace EliteFifa\CompetitorBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\CompetitorBundle\Entity\Competitor;

class CompetitorRepository extends EntityRepository
{
    /**
     * @param Competitor $competitor
     * @param bool $sync
     */
    public function persist(Competitor $competitor, bool $sync = true)
    {
        $this->getEntityManager()->persist($competitor);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}