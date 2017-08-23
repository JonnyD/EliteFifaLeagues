<?php

namespace EliteFifa\JobBundle\EventListener;

use EliteFifa\CompetitorBundle\Event\CompetitorEvent;
use EliteFifa\CompetitorBundle\Event\CompetitorEvents;
use EliteFifa\JobBundle\Service\JobService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddJobListener implements EventSubscriberInterface
{
    /**
     * @var JobService
     */
    private $jobService;

    /**
     * @param JobService $jobService
     */
    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            CompetitorEvents::COMPETITOR_REMOVED => "onCompetitorRemoved"
        ];
    }

    public function onCompetitorRemoved(CompetitorEvent $competitorEvent)
    {
        $competitor = $competitorEvent->getCompetitor();

    }
}