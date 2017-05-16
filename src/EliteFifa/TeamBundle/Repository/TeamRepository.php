<?php

namespace EliteFifa\TeamBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{
    public function findTeamsWithoutAManager()
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT t FROM EliteFifaBundle:Team t
                WHERE t.user IS NULL');

        return $query->getResult();
    }
}