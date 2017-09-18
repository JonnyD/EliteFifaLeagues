<?php

namespace EliteFifa\StandingBundle\EventListener;

use EliteFifa\MatchBundle\Event\MatchEvent;
use EliteFifa\MatchBundle\Event\MatchEvents;
use EliteFifa\StandingBundle\Service\StandingService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UpdateStandingsListener implements EventSubscriberInterface
{
    /**
     * @var StandingService
     */
    private $standingService;

    /**
     * @param StandingService $standingService
     */
    public function __construct(StandingService $standingService)
    {
        $this->standingService = $standingService;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            MatchEvents::CONFIRMED => "onMatchConfirmed"
        ];
    }

    /**
     * @param MatchEvent $matchEvent
     */
    public function onMatchConfirmed(MatchEvent $matchEvent)
    {
        $match = $matchEvent->getMatch();
        $this->standingService->updateStandingsByMatch($match);
    }
}
