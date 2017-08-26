<?php

namespace EliteFifa\CompetitorBundle\EventListener;

use EliteFifa\CompetitorBundle\Service\CompetitorService;
use EliteFifa\JobBundle\Event\JobApplicationEvent;
use EliteFifa\JobBundle\Event\JobApplicationEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UpdateUserListener implements EventSubscriberInterface
{
    /**
     * @var CompetitorService
     */
    private $competitorService;

    /**
     * @param CompetitorService $competitorService
     */
    public function __construct(CompetitorService $competitorService)
    {
        $this->competitorService = $competitorService;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            JobApplicationEvents::JOB_APPLICATION_ACCEPTED => "onJobApplicationAccepted"
        ];
    }

    /**
     * @param JobApplicationEvent $jobApplicationEvent
     */
    public function onJobApplicationAccepted(JobApplicationEvent $jobApplicationEvent)
    {
        $jobApplication = $jobApplicationEvent->getJobApplication();
        $this->competitorService->updateUserFromJobApplication($jobApplication);
    }
}