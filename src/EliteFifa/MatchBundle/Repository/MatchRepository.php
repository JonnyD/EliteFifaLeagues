<?php

namespace EliteFifa\MatchBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EliteFifa\MatchBundle\Entity\Match;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\UserBundle\Entity\User;

class MatchRepository extends EntityRepository
{
    public function findMatchesByTeam($team)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE m.homeTeam = :team
                  OR m.awayTeam = :team
                ORDER BY m.round ASC')
            ->setParameter('team', $team);

        return $query->getResult();
    }

    public function findMatchesByTeamCompetitionSeason($team, $competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE (m.homeTeam = :team
                    OR m.awayTeam = :team)
                  AND m.competition = :competition
                  AND m.season = :season
                ORDER BY m.confirmed ASC, m.reported ASC')
            ->setParameter('team', $team)
            ->setParameter('competition', $competition)
            ->setParameter('season', $season);

        return $query->getResult();
    }

    public function findConfirmedMatchesByTeamCompetitionSeasonOrderedByConfirmedDesc($team, $competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE (m.homeTeam = :team
                    OR m.awayTeam = :team)
                  AND m.confirmed IS NOT NULL
                  AND m.competition = :competition
                  AND m.season = :season
                ORDER BY m.confirmed DESC')
            ->setParameter('team', $team)
            ->setParameter('competition', $competition)
            ->setParameter('season', $season);

        return $query->getResult();
    }

    public function findMatchesByUser($user)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE m.homeUser = :usr
                  OR m.awayUser = :usr
                ORDER BY m.round ASC')
            ->setParameter('usr', $user);

        return $query->getResult();
    }

    public function findResultsByUser(User $user)
    {
        $query = $this->getEntityManager()->createQuery('
              SELECT m FROM MatchBundle:Match m
              WHERE (m.homeUser = :user
                OR m.awayUser = :user)
                AND m.confirmed IS NOT NULL
              ORDER BY m.round ASC')
            ->setParameter('user', $user);

        return $query->getResult();
    }

    public function findHomeMatchesByTeam($team)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE m.homeTeam = :team')
            ->setParameter('team', $team);

        return $query->getResult();
    }

    public function findAwayMatchesByTeam($team)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE m.awayTeam = :team')
            ->setParameter('team', $team);

        return $query->getResult();
    }

    public function findMatchesPlayed()
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE m.confirmed IS NOT NULL');

        return $query->getResult();
    }

    public function findLast5MatchesPlayed($team)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                JOIN m.homeTeam homeTeam
                JOIN m.awayTeam awayTeam
                WHERE m.confirmed IS NOT NULL
                  AND (m.homeTeam IS NOT NULL AND homeTeam = :team
                    OR m.awayTeam IS NOT NULL AND awayTeam = :team)')
            ->setParameter('team', $team);

        $query->setMaxResults(5);

        return $query->getResult();
    }

    public function findLastXMatchesPlayed($team, $x)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                JOIN m.homeTeam homeTeam
                JOIN m.awayTeam awayTeam
                WHERE m.confirmed IS NOT NULL
                  AND (m.homeTeam IS NOT NULL AND homeTeam = :team
                    OR m.awayTeam IS NOT NULL AND awayTeam = :team)')
            ->setParameter('team', $team);

        $query->setMaxResults($x);

        return $query->getResult();
    }

    public function findLastXHomeMatchesPlayed($team, $x)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE m.confirmed IS NOT NULL
                  AND m.homeTeam = :team')
            ->setParameter('team', $team);

        $query->setMaxResults($x);

        return $query->getResult();
    }

    public function findLastXAwayMatchesPlayed($team, $x)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE m.confirmed IS NOT NULL
                  AND m.awayTeam = :team')
            ->setParameter('team', $team);

        $query->setMaxResults($x);

        return $query->getResult();
    }

    public function findUnreportedMatches()
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m FROM MatchBundle:Match m
                WHERE m.reported IS NULL');

        return $query->getResult();
    }

    public function findMatchesByCompetitionSeasonOrderedByRound($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                AND m.season = :season
                ORDER BY m.round ASC')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getResult();
    }

    public function findMatchesForCompetitionBySeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                AND m.season = :season
                ORDER BY m.confirmed DESC')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getResult();
    }

    public function findMatchesForCompetitionBySeasonAndRound($competition, $season, $round)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                AND m.season = :season
                AND m.round = :round')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season)
            ->setParameter("round", $round);

        return $query->getResult();
    }

    public function findNumberOfRoundsByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT COUNT(DISTINCT m.round)
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                AND m.season = :season')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getSingleScalarResult();
    }

    public function findPreviousMatchForTeam($team, $competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT m
                FROM MatchBundle:Match m
                WHERE (m.homeTeam = :team
                    OR m.awayTeam = :team)
                  AND m.competition = :competition
                  AND m.season = :season
                ORDER BY m.confirmed DESC')
            ->setParameter("team", $team)
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        $query->setMaxResults(1);
        $query->setFirstResult(1);

        return $query->getSingleResult();
    }

    public function findAmountOfMatchesByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT COUNT(m.id)
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                  AND m.season = :season')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getSingleScalarResult();
    }

    public function findAmountOfMatchesPlayedByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT COUNT(m.id)
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                  AND m.season = :season
                  AND m.confirmed IS NOT NULL')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getSingleScalarResult();
    }

    public function findAmountOfHomeWinsByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT SUM((CASE WHEN m.homeScore > m.awayScore THEN 1 ELSE 0 END))
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                  AND m.season = :season
                  AND m.confirmed IS NOT NULL')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getSingleScalarResult();
    }

    public function findAmountOfAwayWinsByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT SUM((CASE WHEN m.awayScore > m.homeScore THEN 1 ELSE 0 END))
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                  AND m.season = :season
                  AND m.confirmed IS NOT NULL')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getSingleScalarResult();
    }

    public function findAmountOfDrawsByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT SUM((CASE WHEN m.awayScore = m.homeScore THEN 1 ELSE 0 END))
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                  AND m.season = :season
                  AND m.confirmed IS NOT NULL')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getSingleScalarResult();
    }

    public function findAmountOfGoalsByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT SUM(m.homeScore) + SUM(m.awayScore)
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                  AND m.season = :season
                  AND m.confirmed IS NOT NULL')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getSingleScalarResult();
    }

    public function findAmountBothTeamsScoredByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT SUM((CASE WHEN m.homeScore > 0 AND m.awayScore > 0 THEN 1 ELSE 0 END))
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                  AND m.season = :season
                  AND m.confirmed IS NOT NULL')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getSingleScalarResult();
    }

    public function findAverageGoalsPerMatchByCompetitionAndSeason($competition, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT AVG(m.homeScore + m.awayScore)
                FROM MatchBundle:Match m
                WHERE m.competition = :competition
                  AND m.season = :season
                  AND m.confirmed IS NOT NULL')
            ->setParameter("competition", $competition)
            ->setParameter("season", $season);

        return $query->getSingleScalarResult();
    }

    /**
     * @param Season $season
     * @param string $status
     * @return Match[]
     */
    public function findAllBySeasonAndStatus(Season $season, string $status)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('m')
            ->from('MatchBundle:Match', 'm')
            ->where('m.season = :season')
            ->andWhere('m.status = :status')
            ->setParameter('season', $season)
            ->setParameter('status', $status);

        $query = $qb->getQuery();
        $results = $query->getResult();

        return $results;
    }
}