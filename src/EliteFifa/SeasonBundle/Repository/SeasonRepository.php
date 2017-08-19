<?php

namespace EliteFifa\SeasonBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\AssociationBundle\Entity\Association;
use EliteFifa\SeasonBundle\Criteria\SeasonCriteria;
use EliteFifa\SeasonBundle\Entity\Season;

class SeasonRepository extends EntityRepository
{
    /**
     * @param Season $season
     * @param bool $sync
     */
    public function save(Season $season, bool $sync = true)
    {
        $this->getEntityManager()->persist($season);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }

    public function findNumbersByLeague($league)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT COUNT(DISTINCT s.season)
                FROM SeasonBundle:LeagueStanding s
                WHERE s.competition = :league')
            ->setParameter('league', $league);

        return $query->getSingleScalarResult();
    }

    public function findSeasonsByCompetition($competition)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s, c
                FROM SeasonBundle:Season s
                JOIN s.competitions c
                WHERE c = :competition')
            ->setParameter("competition", $competition);

        return $query->getResult();
    }

    public function findCurrentSeasonForLeague($league)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s, c
                FROM SeasonBundle:Season s
                JOIN s.competitions c
                WHERE s.startDate <= :now
                AND s.endDate >= :now
                AND c = :league')
            ->setParameter('league', $league)
            ->setParameter('now', new \DateTime("now"));

        return $query->getOneOrNullResult();
    }

    public function findLatestSeasonForCompetition($competition)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s, c
                FROM SeasonBundle:Season s
                JOIN s.competitions c
                WHERE c = :competition
                ORDER BY s.endDate DESC')
            ->setParameter('competition', $competition);

        $query->setMaxResults(1);

        return $query->getOneOrNullResult();
    }

    /**
     * @param Association $association
     * @return Season
     */
    public function findLatestSeasonByAssociation(Association $association)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s, a
                FROM SeasonBundle:Season s
                JOIN s.association a
                WHERE a = :association
                ORDER BY s.endDate DESC')
            ->setParameter('association', $association);

        $query->setMaxResults(1);

        return $query->getOneOrNullResult();
    }

    public function findSeasonByCompetitionAndNumber($competition, $number)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s, c
                FROM SeasonBundle:Season s
                JOIN s.competitions c
                WHERE s.number = :seasonNumber
                AND c = :competition')
            ->setParameter('seasonNumber', $number)
            ->setParameter('competition', $competition);

        return $query->getOneOrNullResult();
    }

    public function findSeasonByCompetitionAndDate($competition, $date)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s, c
                FROM SeasonBundle:Season s
                JOIN s.competitions c
                WHERE s.startDate <= :date
                  AND s.endDate >= :date
                  AND c = :competition')
            ->setParameter('date', $date)
            ->setParameter('competition', $competition);

        return $query->getOneOrNullResult();
    }

    /**
     * @param SeasonCriteria $criteria
     * @return Season
     */
    public function findSeasonByCriteria(SeasonCriteria $criteria)
    {
        $qb = $this->findSeasonsByCriteriaQueryBuilder($criteria);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();
        $result = $query->getOneOrNullResult();

        return $result;
    }

    /**
     * @param SeasonCriteria $criteria
     * @return Season[]
     */
    public function findSeasonsByCriteria(SeasonCriteria $criteria)
    {
        $qb = $this->findSeasonsByCriteriaQueryBuilder($criteria);

        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }

    /**
     * @param SeasonCriteria $criteria
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findSeasonsByCriteriaQueryBuilder(SeasonCriteria $criteria)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('season')
            ->from('EliteFifa\SeasonBundle\Entity\Season', 'season');

        if ($criteria->getSort()) {
            foreach ($criteria->getSort() as $column => $direction) {
                $qb->addOrderBy($qb->getRootAliases()[0] . '.' . $column, $direction);
            }
        }

        return $qb;
    }
}