<?php

namespace EliteFifa\JobBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\JobBundle\Entity\JobApplication;

class JobApplicationRepository extends EntityRepository
{
    /**
     * @param JobApplication $jobApplication
     * @param bool $sync
     */
    public function save(JobApplication $jobApplication, bool $sync = true)
    {
        $this->getEntityManager()->persist($jobApplication);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}