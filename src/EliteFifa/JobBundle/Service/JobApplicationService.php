<?php

namespace EliteFifa\JobBundle\Service;

use EliteFifa\JobBundle\Entity\JobApplication;
use EliteFifa\JobBundle\Event\JobApplicationEvent;
use EliteFifa\JobBundle\Event\JobApplicationEvents;
use EliteFifa\JobBundle\Repository\JobApplicationRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class JobApplicationService
{
    /**
     * @var JobApplicationRepository
     */
    private $jobApplicationRepository;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param JobApplicationRepository $jobApplicationRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        JobApplicationRepository $jobApplicationRepository,
        EventDispatcherInterface $eventDispatcher)
    {
        $this->jobApplicationRepository = $jobApplicationRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param int $id
     * @return null|JobApplication
     */
    public function getJobApplicationById(int $id)
    {
        return $this->jobApplicationRepository->find($id);
    }

    /**
     * @param JobApplication $jobApplication
     */
    public function accept(JobApplication $jobApplication)
    {
        $this->eventDispatcher->dispatch(JobApplicationEvents::JOB_APPLICATION_ACCEPTED, new JobApplicationEvent($jobApplication));
    }

    /**
     * @param JobApplication $jobApplication
     * @param bool $sync
     */
    public function save(JobApplication $jobApplication, $sync = true)
    {
        $this->jobApplicationRepository->save($jobApplication, $sync);
    }
}