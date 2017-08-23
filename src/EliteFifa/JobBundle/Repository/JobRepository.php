<?php

namespace EliteFifa\JobBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\JobBundle\Entity\Job;

class JobRepository extends EntityRepository
{
    /**
     * @param Job $job
     * @param bool $sync
     */
    public function save(Job $job, bool $sync = true)
    {
        $this->getEntityManager()->persist($job);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}