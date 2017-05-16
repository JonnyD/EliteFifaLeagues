<?php

namespace EliteFifa\MatchBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\MatchBundle\Repository\RoundRepository;
use EliteFifa\SeasonBundle\Entity\Season;

class RoundService
{
    /**
     * @var RoundRepository $roundRepository
     */
    private $roundRepository;

    /**
     * @param RoundRepository $roundRepository
     */
    public function __construct(RoundRepository $roundRepository)
    {
        $this->roundRepository = $roundRepository;
    }

    /**
     * @param Competition $competition
     * @param Season $season
     * @return ArrayCollection|Round[]
     */
    public function getRoundsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        return $this->roundRepository->findRoundsByCompetitionAndSeason($competition, $season);
    }
}