<?php

namespace EliteFifa\CompetitorBundle\Service;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Criteria\CompetitorCriteria;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\CompetitorBundle\Event\CompetitorEvent;
use EliteFifa\CompetitorBundle\Event\CompetitorEvents;
use EliteFifa\CompetitorBundle\Repository\CompetitorRepository;
use EliteFifa\JobBundle\Entity\JobApplication;
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
     * @param Season $season
     * @return Competitor[]
     */
    public function getCompetitorsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        return $this->competitorRepository->findByCompetitionsAndSeason(array($competition), $season);
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
     * @param JobApplication $jobApplication
     */
    public function updateUserFromJobApplication(JobApplication $jobApplication)
    {
        $job = $jobApplication->getJob();
        $season = $job->getSeason();
        $competitor = $job->getCompetitor();
        $user = $jobApplication->getUser();

        $criteria = new CompetitorCriteria();
        $criteria->setSeason($season);
        $criteria->setUser($user);
        $oldCompetitor = $this->competitorRepository->findCompetitorByCriteria($criteria);
        if ($oldCompetitor != null) {
            $this->removeUser($oldCompetitor);
        }

        $competitor->setUser($user);
        $this->save($competitor);
    }

    /**
     * @param Competitor $competitor
     * @param bool $sync
     */
    public function save(Competitor $competitor, bool $sync = true)
    {
        $this->competitorRepository->save($competitor, $sync);
    }
}