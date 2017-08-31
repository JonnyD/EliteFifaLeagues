<?php

namespace EliteFifa\CompetitorBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use EliteFifa\CompetitorBundle\Criteria\CompetitorCriteria;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\SeasonBundle\Entity\Season;

class CompetitorRepository extends EntityRepository
{
    /**
     * @param array $competitions
     * @param Season $season
     * @return ArrayCollection|Competitor[]
     */
    public function findByCompetitionsAndSeason(array $competitions, Season $season)
    {
        $qb = $this->createQueryBuilder('competitor');
        $qb->join('competitor.competitions', 'competition');

        for($i = 0; $i < count($competitions); $i++) {
            $qb->andWhere($qb->expr()->eq('competition.id', ':competition' . $i));
            $qb->setParameter('competition' . $i, $competitions[$i]);
        }

        $qb->andWhere('competitor.season = :season')
            ->setParameter('season', $season);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param CompetitorCriteria $criteria
     * @return Competitor
     */
    public function findCompetitorByCriteria(CompetitorCriteria $criteria)
    {
        $qb = $this->findCompetitorsByCriteriaQueryBuilder($criteria);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();
        $result = $query->getOneOrNullResult();

        return $result;
    }

    /**
     * @param CompetitorCriteria $criteria
     * @return Competitor[]
     */
    public function findCompetitorsByCriteria(CompetitorCriteria $criteria)
    {
        $qb = $this->findCompetitorsByCriteriaQueryBuilder($criteria);

        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }

    /**
     * @param CompetitorCriteria $criteria
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findCompetitorsByCriteriaQueryBuilder(CompetitorCriteria $criteria)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('competitor')
            ->from('EliteFifa\CompetitorBundle\Entity\Competitor', 'competitor');

        if ($criteria->getUser()) {
            $qb->andWhere('competitor.user = :user')
                ->setParameter('user', $criteria->getUser());
        }

        if ($criteria->getStatus()) {
            $qb->andWhere('competitor.status = :status')
                ->setParameter('status', $criteria->getStatus());
        }

        if ($criteria->getSeason()) {
            $qb->andWhere('competitor.season = :season')
                ->setParameter('season', $criteria->getSeason());
        }

        if ($criteria->getTeam()) {
            $qb->andWhere('competitor.team = :team')
                ->setParameter('team', $criteria->getTeam());
        }

        return $qb;
    }

    /**
     * @param Competitor $competitor
     * @param bool $sync
     */
    public function save(Competitor $competitor, bool $sync = true)
    {
        $this->getEntityManager()->persist($competitor);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}