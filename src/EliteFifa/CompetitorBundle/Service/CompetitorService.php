<?php

namespace EliteFifa\CompetitorBundle\Service;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\CompetitorBundle\Repository\CompetitorRepository;

class CompetitorService
{
    /**
     * @var CompetitorRepository
     */
    private $competitorRepository;

    /**
     * @param CompetitorRepository $competitorRepository
     */
    public function __construct(CompetitorRepository $competitorRepository)
    {
        $this->competitorRepository = $competitorRepository;
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
        return $this->competitorRepository->findBy([
            'competition' => $competition
        ]);
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