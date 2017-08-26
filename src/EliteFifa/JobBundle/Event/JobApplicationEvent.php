<?php

namespace EliteFifa\JobBundle\Event;

use EliteFifa\JobBundle\Entity\JobApplication;
use Symfony\Component\EventDispatcher\Event;

class JobApplicationEvent extends Event
{
    /**
     * @var JobApplication
     */
    private $jobApplication;

    /**
     * @param JobApplication $jobApplication
     */
    public function __construct(JobApplication $jobApplication)
    {
        $this->jobApplication = $jobApplication;
    }

    /**
     * @return JobApplication
     */
    public function getJobApplication()
    {
        return $this->jobApplication;
    }

    /**
     * @param JobApplication $jobApplication
     */
    public function setJobApplication($jobApplication)
    {
        $this->jobApplication = $jobApplication;
    }
}
