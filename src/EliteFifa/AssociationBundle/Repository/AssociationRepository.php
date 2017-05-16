<?php

namespace EliteFifa\AssociationBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\AssociationBundle\Entity\Association;

class AssociationRepository extends EntityRepository
{
    /**
     * @param Association $association
     * @param bool $sync
     */
    public function save(Association $association, bool $sync = true)
    {
        $this->getEntityManager()->persist($association);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}