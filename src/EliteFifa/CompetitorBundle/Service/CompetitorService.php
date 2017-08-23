<?php

namespace EliteFifa\CompetitorBundle\Service;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\CompetitorBundle\Event\CompetitorEvent;
use EliteFifa\CompetitorBundle\Event\CompetitorEvents;
use EliteFifa\CompetitorBundle\Repository\CompetitorRepository;
use EliteFifa\SeasonBundle\Entity\Season;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CompetitorService
{
    /**
     * @var CompetitorRepository
     */
    private $competitorRepository;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param CompetitorRepository $competitorRepository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        CompetitorRepository $competitorRepository,
        EventDispatcherInterface $eventDispatcher)
    {
        $this->competitorRepository = $competitorRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param int $id
     * @return Competitor
     */
    public function getCompetitorById(int $id)
    {
        return $this->competitorRepository->find($id);
    }

    /**
     * @param Competition $competition
     * @return Competitor[]
     */
    public function getCompetitorsByCompetition(Competition $competition)
    {
        return $this->competitorRepository->findByCompetitions(array($competition));
    }

    /**
     * @param Competitor $competitor
     */
    public function removeUser(Competitor $competitor)
    {
        $competitor->setUser(null);
        $this->save($competitor);
        $this->eventDispatcher->dispatch(CompetitorEvents::COMPETITOR_REMOVED, new CompetitorEvent($competitor));
    }

    /**
     * @param Competitor $competitor
     * @param bool $sync
     */
    public function save(Competitor $competitor, bool $sync = true)
    {
        $this->competitorRepository->persist($competitor);
        if ($sync) {
            $this->competitorRepository->flush();
        }
    }
}