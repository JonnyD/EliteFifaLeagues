<?php

namespace EliteFifa\CompetitionBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\CompetitionBundle\Entity\Stat;

//todo
class StatsRepository extends EntityRepository
{
    public function findBiggestWinByCompetitionAndSeason(Competition $competition, Season $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s, abs(m.homeScore - m.awayScore) as goalDifference
                FROM EliteFifaBundle:Stats s
                JOIN s.biggestWin m
                WHERE s.competition = :competition
                  AND s.season = :season
                ORDER BY goalDifference DESC')
            ->setParameter('competition', $competition)
            ->setParameter('season', $season);

        $query->setMaxResults(1);

        return $query->getSingleResult();
    }

    public function findBiggestWinByCompetition(Competition $competition)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s, abs(m.homeScore - m.awayScore) as goalDifference
                FROM EliteFifaBundle:Stats s
                JOIN s.biggestWin m
                WHERE s.competition = :competition
                ORDER BY goalDifference DESC')
            ->setParameter('competition', $competition);

        $query->setMaxResults(1);

        return $query->getSingleResult();
    }

    public function findHighestScoringMatchByCompetitionAndSeason(Competition $competition, Season $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s, m.homeScore + m.awayScore as goalsScored
                FROM EliteFifaBundle:Stats s
                JOIN s.biggestWin m
                WHERE s.competition = :competition
                  AND s.season = :season
                ORDER BY goalsScored DESC')
            ->setParameter('competition', $competition)
            ->setParameter('season', $season);

        $query->setMaxResults(1);

        return $query->getSingleResult();
    }
}