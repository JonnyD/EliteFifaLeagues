<?php

namespace EliteFifa\CompetitorBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use EliteFifa\CompetitorBundle\Entity\Competitor;

class CompetitorRepository extends EntityRepository
{
    /**
     * @param array $competitions
     * @return ArrayCollection|Competitor[]
     */
    public function findByCompetitions(array $competitions)
    {
        $qb = $this->createQueryBuilder('competitor');
        $qb->join('competitor.competitions', 'competition');

        for($i = 0; $i < count($competitions); $i++) {
            $qb->andWhere($qb->expr()->eq('competition.id', ':competition' . $i));
            $qb->setParameter('competition' . $i, $competitions[$i]);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * @param Competitor $competitor
     * @param bool $sync
     */
    public function persist(Competitor $competitor, bool $sync = true)
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