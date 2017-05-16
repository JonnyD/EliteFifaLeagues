<?php

namespace EliteFifa\CompetitionBundle\Service;

use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitionBundle\Repository\CompetitionRepository;
use EliteFifa\SeasonBundle\Entity\Season;

class CompetitionService
{
    /**
     * @var CompetitionRepository
     */
    private $competitionRepository;

    /**
     * @param CompetitionRepository $competitionRepository
     */
    public function __construct(CompetitionRepository $competitionRepository)
    {
        $this->competitionRepository = $competitionRepository;
    }

    /**
     * @param string $slug
     * @return Competition
     */
    public function getCompetitionBySlug($slug)
    {
        return $this->competitionRepository->findOneBy([
            'slug' => $slug
        ]);
    }

    /**
     * @param Association $association
     * @return Competition[]
     */
    public function getCompetitionsByAssociation(Association $association)
    {
        return $this->competitionRepository->findBy([
            'association' => $association
        ]);
    }

    /**
     * @param Association $association
     * @param Season $season
     * @return Competition[]
     */
    public function getCompetitionsByAssociationAndSeason(Association $association, Season $season)
    {
        $competitionsByAssociation = $this->getCompetitionsByAssociation($association);

        $competitionsBySeason = [];
        foreach ($competitionsByAssociation as $competition) {
            if ($competition->hasSeason($season)) {
                $competitionsBySeason[] = $competition;
            }
        }

        return $competitionsBySeason;
    }
}