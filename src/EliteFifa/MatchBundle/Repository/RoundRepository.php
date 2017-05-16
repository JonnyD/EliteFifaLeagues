<?php

namespace EliteFifa\MatchBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\SeasonBundle\Entity\Season;

class RoundRepository extends EntityRepository
{
    /**
     * @param Competition $competition
     * @param Season $season
     * @return Round[]|ArrayCollection
     */
    public function findRoundsByCompetitionAndSeason(Competition $competition, Season $season)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select('r')
            ->from('MatchBundle:Round', 'r');

        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }
}