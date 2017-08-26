<?php

namespace EliteFifa\CareerBundle\EventListener;

use EliteFifa\CareerBundle\Service\CareerService;
use EliteFifa\JobBundle\Event\JobApplicationEvent;
use EliteFifa\JobBundle\Event\JobApplicationEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UpdateCareerListener implements EventSubscriberInterface
{
    /**
     * @var CareerService
     */
    private $careerService;

    /**
     * @param CareerService $careerService
     */
    public function __construct(CareerService $careerService)
    {
        $this->careerService = $careerService;
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
        $this->careerService->updateCareerByJobApplication($jobApplication);
    }
}