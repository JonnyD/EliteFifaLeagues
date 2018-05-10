<?php

namespace EliteFifa\StandingBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\StandingBundle\Criteria\StandingCriteria;
use EliteFifa\StandingBundle\Entity\Standing;

class StandingRepository extends EntityRepository
{
    /**
     * @param StandingCriteria $criteria
     * @return Standing
     */
    public function findStandingByCriteria(StandingCriteria $criteria)
    {
        $qb = $this->findStandingsByCriteriaQueryBuilder($criteria);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();
        $result = $query->getOneOrNullResult();

        return $result;
    }

    /**
     * @param StandingCriteria $criteria
     * @return Standing[]
     */
    public function findStandingsByCriteria(StandingCriteria $criteria)
    {
        $qb = $this->findStandingsByCriteriaQueryBuilder($criteria);

        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }

    /**
     * @param StandingCriteria $criteria
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findStandingsByCriteriaQueryBuilder(StandingCriteria $criteria)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('standing')
            ->from('EliteFifa\StandingBundle\Entity\Standing', 'standing');

        if ($criteria->getTableType()) {
            $qb->andWhere('standing.tableType = :tableType')
                ->setParameter('tableType', $criteria->getTableType());
        }

        if ($criteria->getStandingType()) {
            $qb->andWhere('standing.standingType = :standingType')
                ->setParameter('standingType', $criteria->getStandingType());
        }

        if ($criteria->getCompetition()) {
            $qb->andWhere('standing.competition = :competition')
                ->setParameter('competition', $criteria->getCompetition());
        }

        if ($criteria->getSeason()) {
            $qb->andWhere('standing.season = :season')
                ->setParameter('season', $criteria->getSeason());
        }

        if ($criteria->getCompetitor()) {
            $qb->andWhere('standing.competitor = :competitor')
                ->setParameter('competitor', $criteria->getCompetitor());
        }

        if ($criteria->getSort()) {
            foreach ($criteria->getSort() as $column => $direction) {
                $qb->addOrderBy($qb->getRootAliases()[0] . '.' . $column, $direction);
            }
        }

        if ($criteria->getLimit()) {
            $qb->setMaxResults($criteria->getLimit());
        }

        return $qb;
    }

    /**
     * @param Standing $standing
     * @param bool $sync
     */
    public function save(Standing $standing, bool $sync = true)
    {
        $this->getEntityManager()->persist($standing);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}