<?php

namespace EliteFifa\CareerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\CareerBundle\Criteria\CareerCriteria;
use EliteFifa\CareerBundle\Entity\Career;

class CareerRepository extends EntityRepository
{
    /**
     * @param CareerCriteria $criteria
     * @return Career[]
     */
    public function findCareersByCriteria(CareerCriteria $criteria)
    {
        $qb = $this->findCareersByCriteriaQueryBuilder($criteria);

        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }

    /**
     * @param CareerCriteria $criteria
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findCareersByCriteriaQueryBuilder(CareerCriteria $criteria)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('career')
            ->from('EliteFifa\CareerBundle\Entity\Career', 'career');

        if ($criteria->getUser()) {
            $qb->andWhere('career.user = :user')
                ->setParameter('user', $criteria->getUser());
        }

        return $qb;
    }
}