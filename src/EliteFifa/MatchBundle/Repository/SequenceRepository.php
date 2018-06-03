<?php

namespace EliteFifa\MatchBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\CompetitionBundle\Entity\Stage;
use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\MatchBundle\Criteria\MatchCriteria;
use EliteFifa\MatchBundle\Criteria\SequenceCriteria;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\MatchBundle\Entity\Sequence;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\UserBundle\Entity\User;

class SequenceRepository extends EntityRepository
{
    /**
     * @param SequenceCriteria $criteria
     * @return Sequence
     */
    public function findSequenceByCriteria(SequenceCriteria $criteria)
    {
        $qb = $this->findSequencesByCriteriaQueryBuilder($criteria);
        $qb->setMaxResults(1);

        $query = $qb->getQuery();
        $result = $query->getOneOrNullResult();

        return $result;
    }

    /**
     * @param SequenceCriteria $criteria
     * @return Sequence[]
     */
    public function findSequencesByCriteria(SequenceCriteria $criteria)
    {
        $qb = $this->findSequencesByCriteriaQueryBuilder($criteria);

        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }

    /**
     * @param SequenceCriteria $criteria
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findSequencesByCriteriaQueryBuilder(SequenceCriteria $criteria)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('sequence')
            ->from('EliteFifa\MatchBundle\Entity\Sequence', 'sequence');

        if ($criteria->getSequenceType()) {
            $qb->andWhere('sequence.sequenceType = :sequenceType')
                ->setParameter('sequenceType', $criteria->getSequenceType());
        }

        if ($criteria->getCompetition()) {
            $qb->andWhere('sequence.competition = :competition')
                ->setParameter('competition', $criteria->getCompetition());
        }

        if ($criteria->getSeason()) {
            $qb->andWhere('sequence.season = :season')
                ->setParameter('season', $criteria->getSeason());
        }

        if ($criteria->getCompetitor()) {
            $qb->andWhere('sequence.competitor = :competitor')
                ->setParameter('competitor', $criteria->getCompetitor());
        }

        return $qb;
    }

    /**
     * @param Sequence $sequence
     * @param bool $sync
     */
    public function save(Sequence $sequence, bool $sync = true)
    {
        $this->getEntityManager()->persist($sequence);
        if ($sync) {
            $this->flush();
        }
    }

    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}