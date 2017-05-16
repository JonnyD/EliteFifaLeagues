<?php

namespace EliteFifa\MatchBundle\Service;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\MatchBundle\Entity\Event;
use EliteFifa\MatchBundle\Entity\EventType;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\PlayerBundle\Entity\Player;
use EliteFifa\MatchBundle\Repository\EventRepository;
use Doctrine\ORM\EntityManager;
use EliteFifa\MatchBundle\Repository\EventTypeRepository;

class EventService
{
    private $eventRepository;
    private $eventTypeRepository;

    public function __construct(EventRepository $eventRepository,
                                EventTypeRepository $eventTypeRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->eventTypeRepository = $eventTypeRepository;
    }

    public function createEvent(EventType $eventType, Player $player, Team $team, Match $match)
    {
        $event = new Event();
        $event->setEventType($eventType);
        $event->setPlayer($player);
        $event->setTeam($team);
        $event->setMatch($match);
        return $event;
    }

    public function getTopScorersByCompetitionAndSeason($competition, $season)
    {
        return $this->eventRepository->findTopGoalScorersByCompetitionAndSeason($competition, $season);
    }

    public function getTopMOMByCompetitionAndSeason($competition, $season)
    {
        return $this->eventRepository->findTopMOMByCompetitionAndSeason($competition, $season);
    }

    public function getTopBookingsByCompetitionAndSeason($competition, $season)
    {
        return $this->eventRepository->findTopBookingsByCompetiitonAndSeason($competition, $season);
    }

    public function getTopCleanSheetsByCompetitionAndSeason($competition, $season)
    {
        return $this->eventRepository->findTopCleanSheetsByCompetitionAndSeason($competition, $season);
    }

    public function getYellowAmountForTeamByCompetitionAndSeason(Team $team, Competition $competition, Season $season)
    {
        return $this->eventRepository->findAmountOfYellowsForTeamByCompetitionAndSeason($team, $competition, $season);
    }

    public function getRedAmountForTeamByCompetitionAndSeason(Team $team, Competition $competition, Season $season)
    {
        return $this->eventRepository->findAmountOfRedsForTeamByCompetitionAndSeason($team, $competition, $season);
    }

    public function getEventTypeByName($name)
    {
        return $this->eventTypeRepository->findOneByName($name);
    }
}