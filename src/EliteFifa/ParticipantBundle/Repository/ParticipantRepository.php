<?php

namespace EliteFifa\ParticipantBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParticipantRepository extends EntityRepository
{
    public function findParticipantsByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('
                SELECT p FROM EliteFifaBundle:Participant p
                WHERE p.competition = :competition
                  AND p.season = :season')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getResult();
    }
}