<?php

namespace EliteFifa\CompetitionBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use EliteFifa\CompetitionBundle\Entity\LeagueStanding;

class LeagueStandingRepository extends EntityRepository
{
    /**
     * @param $league
     * @param $season
     * @return ArrayCollection|LeagueStanding[]
     */
    public function findByLeagueAndSeason($league, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s FROM EliteFifaBundle:LeagueStanding s
                WHERE s.league = :league
                AND s.season = :season
                ORDER BY s.points DESC, s.goalDifference, s.won, s.lost')
            ->setParameter('league', $league)
            ->setParameter('season', $season);

        return $query->getResult();
    }

    /**
     * @param $league
     * @param $season
     * @return ArrayCollection|LeagueStanding[]
     */
    public function findByLeagueAndSeasonOrderedByHomePoints($league, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s
                FROM EliteFifaBundle:LeagueStanding s
                WHERE s.league = :league
                AND s.season = :season
                ORDER BY s.homePoints DESC, s.homeGoalDifference, s.homeWon, s.homeLost')
            ->setParameter('league', $league)
            ->setParameter('season', $season);

        return $query->getResult();
    }

    /**
     * @param $league
     * @param $season
     * @return ArrayCollection|LeagueStanding[]
     */
    public function findByLeagueAndSeasonOrderedByAwayPoints($league, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s
                FROM EliteFifaBundle:LeagueStanding s
                WHERE s.league = :league
                AND s.season = :season
                ORDER BY s.awayPoints DESC, s.awayGoalDifference, s.awayWon, s.awayLost')
            ->setParameter('league', $league)
            ->setParameter('season', $season);

        return $query->getResult();
    }

    /**
     * @param $team
     * @param $league
     * @param $season
     * @return ArrayCollection|LeagueStanding[]
     */
    public function findByTeamLeagueSeason($team, $league, $season)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s FROM EliteFifaBundle:LeagueStanding s
                WHERE s.league = :league AND s.team = :team
                AND s.season = :season')
            ->setParameter('league', $league)
            ->setParameter('team', $team)
            ->setParameter('season', $season);

        return $query->getResult();
    }

    /**
     * @param $league
     * @param $season
     * @param $limit
     * @return mixed
     * @todo clean, add mapper
     */
    public function findByMatchesLeagueSeason($league, $season, $limit)
    {
        $sql = "select team_id, team_name, user_id, username, count(*) as P, sum(W) as W, sum(D) as D, sum(L) as L, sum(GF) as GF, sum(GA) as GA, sum(GD) as GD, sum(PTS) as PTS from (
                select home_team_id as team_id,
                    team.name as team_name,
                    home_user_id as user_id,
                    user.username as username,
                       case when home_score > away_score then 1
                            else 0 end as W,
                       case when home_score = away_score then 1
                            else 0 end as D,
                       case when home_score < away_score then 1
                            else 0 end as L,
                       home_score as GF,
                       away_score as GA,
                       home_score-away_score as GD,
                       case when home_score > away_score then 3
                            when home_score = away_score then 1
                            else 0 end as PTS
                from matches
                INNER JOIN team ON matches.home_team_id = team.id
                INNER JOIN user ON matches.home_user_id = user.id
                where league_id = 94 and season_id = 82 and confirmed is not null
                union all
                select away_team_id as team_id,
                    team.name as team_name,
                    away_user_id as user_id,
                    user.username as username,
                       case when home_score < away_score then 1
                            else 0 end as W,
                       case when home_score = away_score then 1
                            else 0 end as D,
                       case when home_score > away_score then 1
                            else 0 end as L,
                       away_score as GF,
                       home_score as GA,
                       away_score-home_score as GD,
                       case when home_score < away_score then 3
                            when home_score = away_score then 1
                            else 0 end as PTS
                from matches
                INNER JOIN team ON matches.away_team_id = team.id
                INNER JOIN user ON matches.away_team_id = user.id
                where league_id = 94 and season_id = 82 and confirmed is not null
                ) as results
            group by team_id
            order by pts DESC,gd DESC,gf DESC;";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('team_id', 'team_id');
        $rsm->addScalarResult('team_name', 'team_name');
        $rsm->addScalarResult('user_id', 'user_id');
        $rsm->addScalarResult('username', 'username');
        $rsm->addScalarResult('P', 'played');
        $rsm->addScalarResult('W', 'won');
        $rsm->addScalarResult('D', 'drawn');
        $rsm->addScalarResult('L', 'lost');
        $rsm->addScalarResult('GF', 'goalsFor');
        $rsm->addScalarResult('GA', 'goalsAgainst');
        $rsm->addScalarResult('GD', 'goalDifference');
        $rsm->addScalarResult('PTS', 'points');

        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        $query->setParameter(1, 94);
        $query->setParameter(2, 82);

        return $query->getResult();
    }

    /**
     * @param $league
     * @param $season
     * @param $limit
     * @return ArrayCollection|LeagueStanding[]
     */
    public function findByMostPlayed($league, $season, $limit)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s
                FROM EliteFifaBundle:LeagueStanding s
                WHERE s.league = :league
                AND s.season = :season
                ORDER BY s.played DESC')
            ->setParameter('league', $league)
            ->setParameter('season', $season);

        if ($limit > 0) {
            $query->setMaxResults($limit);
        }

        return $query->getResult();
    }

    /**
     * @param $league
     * @param $season
     * @param $limit
     * @return ArrayCollection|LeagueStanding[]
     */
    public function findByMostWon($league, $season, $limit)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s
                FROM EliteFifaBundle:LeagueStanding s
                WHERE s.league = :league
                AND s.season = :season
                ORDER BY s.won DESC')
            ->setParameter('league', $league)
            ->setParameter('season', $season);

        if ($limit > 0) {
            $query->setMaxResults($limit);
        }

        return $query->getResult();
    }

    /**
     * @param $league
     * @param $season
     * @param $limit
     * @return ArrayCollection|LeagueStanding[]
     */
    public function findByMostDrawn($league, $season, $limit)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s
                FROM EliteFifaBundle:LeagueStanding s
                WHERE s.league = :league
                AND s.season = :season
                ORDER BY s.drawn DESC')
            ->setParameter('league', $league)
            ->setParameter('season', $season);

        if ($limit > 0) {
            $query->setMaxResults($limit);
        }

        return $query->getResult();
    }

    /**
     * @param $league
     * @param $season
     * @param $limit
     * @return ArrayCollection|LeagueStanding[]
     */
    public function findByMostLost($league, $season, $limit)
    {
        $query = $this->getEntityManager()
            ->createQuery('SELECT s
                FROM EliteFifaBundle:LeagueStanding s
                WHERE s.league = :league
                AND s.season = :season
                ORDER BY s.lost DESC')
            ->setParameter('league', $league)
            ->setParameter('season', $season);

        if ($limit > 0) {
            $query->setMaxResults($limit);
        }

        return $query->getResult();
    }
}