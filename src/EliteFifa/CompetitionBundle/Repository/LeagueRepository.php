<?php

namespace EliteFifa\Bundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use EliteFifa\Bundle\Entity\LeagueStanding;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\User;

//TODO REFACTOR/CLEAN
class LeagueRepository extends EntityRepository
{
    public function findStandingsByLeagueAndSeason($league, $season)
    {
        $sql = 'SELECT team.name AS team_name,
                   team_id AS team_id,
                   COUNT(*) AS played,
                   SUM((CASE WHEN team_score > other_team_score THEN 1 ELSE 0 END)) AS won,
                   SUM((CASE WHEN team_score < other_team_score THEN 1 ELSE 0 END)) AS lost,
                   SUM((CASE WHEN team_score = other_team_score THEN 1 ELSE 0 END)) AS drawn,
                   SUM(team_score) AS goals_for,
                   SUM(other_team_score) AS goals_against,
                   SUM(team_score - other_team_score) AS goal_difference,
                   SUM((CASE WHEN team_score > other_team_score THEN 3
                             WHEN team_score = other_team_score THEN 1
                             ELSE 0 END)) AS points
                FROM
                (
                    -- LIST TEAM STATS WHEN PLAYED AS HOME_TEAM
                    SELECT
                         id,
                         league_id,
                         season_id,
                         home_team_id as team_id,
                         home_score   as team_score,
                         away_score   as other_team_score,
                         confirmed
                    FROM    matches
                    UNION ALL
                    -- LIST TEAM STATS WHEN PLAYED AS AWAY_TEAM
                    SELECT
                         id,
                         league_id,
                         season_id,
                         away_team_id as team_id,
                         away_score   as team_score,
                         home_score   as other_team_score,
                         confirmed
                    FROM matches
                ) matches
            INNER JOIN team ON matches.team_id = team.id
            WHERE league_id = ?
                AND season_id = ?
                AND confirmed IS NOT NULL
            GROUP BY team.name, team_id
            ORDER BY POINTS DESC';

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('team_id', 'teamId');
        $rsm->addScalarResult('team_name', 'teamName');
        $rsm->addScalarResult('played', 'played');
        $rsm->addScalarResult('won', 'won');
        $rsm->addScalarResult('lost', 'lost');
        $rsm->addScalarResult('drawn', 'drawn');
        $rsm->addScalarResult('goals_for', 'goalsFor');
        $rsm->addScalarResult('goals_against', 'goalsAgainst');
        $rsm->addScalarResult('goal_difference', 'goalDifference');
        $rsm->addScalarResult('points', 'points');
        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $league->getId());
        $query->setParameter(2, $season->getId());
        $results = $query->getResult();

        $standings = array();
        foreach ($results as $result) {
            $standing = new LeagueStanding();
            $standing->setPlayed($result["played"]);
            $standing->setWon($result["won"]);
            $standing->setLost($result["lost"]);
            $standing->setDrawn($result["drawn"]);
            $standing->setGoalsFor($result["goalsFor"]);
            $standing->setGoalsAgainst($result["goalsAgainst"]);
            $standing->setPoints($result["points"]);

            $team = new Team();
            $team->setName($result["teamName"]);
            $standing->setTeam($team);

            $standings[] = $standing;
        }

        return $standings;
    }

    public function findUserStandingsByLeagueAndSeason($league, $season)
{
    $sql = 'SELECT user.username AS username,
                   user_id AS user_id,
                   COUNT(*) AS played,
                   SUM((CASE WHEN team_score > other_team_score THEN 1 ELSE 0 END)) AS won,
                   SUM((CASE WHEN team_score < other_team_score THEN 1 ELSE 0 END)) AS lost,
                   SUM((CASE WHEN team_score = other_team_score THEN 1 ELSE 0 END)) AS drawn,
                   SUM(team_score) AS goals_for,
                   SUM(other_team_score) AS goals_against,
                   SUM(team_score - other_team_score) AS goal_difference,
                   SUM((CASE WHEN team_score > other_team_score THEN 3
                             WHEN team_score = other_team_score THEN 1
                             ELSE 0 END)) AS points
                FROM
                (
                    -- LIST TEAM STATS WHEN PLAYED AS HOME_TEAM
                    SELECT
                         id,
                         league_id,
                         season_id,
                         home_user_id as user_id,
                         home_score   as team_score,
                         away_score   as other_team_score,
                         confirmed
                    FROM    matches
                    UNION ALL
                    -- LIST TEAM STATS WHEN PLAYED AS AWAY_TEAM
                    SELECT
                         id,
                         league_id,
                         season_id,
                         away_user_id as user_id,
                         away_score   as team_score,
                         home_score   as other_team_score,
                         confirmed
                    FROM matches
                ) matches
            INNER JOIN user ON matches.user_id = user.id
            WHERE league_id = ?
                AND season_id = ?
                AND confirmed IS NOT NULL
            GROUP BY username, user_id
            ORDER BY POINTS DESC';

    $rsm = new ResultSetMapping();
    $rsm->addScalarResult('user_id', 'userId');
    $rsm->addScalarResult('username', 'username');
    $rsm->addScalarResult('played', 'played');
    $rsm->addScalarResult('won', 'won');
    $rsm->addScalarResult('lost', 'lost');
    $rsm->addScalarResult('drawn', 'drawn');
    $rsm->addScalarResult('goals_for', 'goalsFor');
    $rsm->addScalarResult('goals_against', 'goalsAgainst');
    $rsm->addScalarResult('goal_difference', 'goalDifference');
    $rsm->addScalarResult('points', 'points');
    $query = $this->_em->createNativeQuery($sql, $rsm);
    $query->setParameter(1, $league->getId());
    $query->setParameter(2, $season->getId());
    $results = $query->getResult();

    $standings = array();
    foreach ($results as $result) {
        $standing = new LeagueStanding();
        $standing->setPlayed($result["played"]);
        $standing->setWon($result["won"]);
        $standing->setLost($result["lost"]);
        $standing->setDrawn($result["drawn"]);
        $standing->setGoalsFor($result["goalsFor"]);
        $standing->setGoalsAgainst($result["goalsAgainst"]);
        $standing->setPoints($result["points"]);

        $user = new User();
        $user->setUsername($result["username"]);
        $standing->setUser($user);

        $standings[] = $standing;
    }

    return $standings;
}

    public function findCurrentPositionForTeamByLeagueAndSeason($team, $league, $season)
    {
        $sql = "SELECT z.position FROM (
                SELECT *, @rownum := @rownum + 1 AS position
                FROM league_standing ls, (SELECT @rownum := 0) r
                ORDER BY points DESC
            ) as z
            WHERE league_id = " . $league->getId() . "
            AND season_id = " . $season->getId() . "
            AND team_id = " . $team->getId() . ";";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('position', 'position');
        $query = $this->_em->createNativeQuery($sql, $rsm);

        return $query->getResult();
    }

    public function findCurrentPositionForTeamByStanding($standing)
    {
        $sql = "SELECT z.position FROM (
                SELECT *, @rownum := @rownum + 1 AS position
                FROM league_standing ls, (SELECT @rownum := 0) r
                ORDER BY points DESC
            ) as z
            WHERE id = " . $standing->getId() . ";";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('position', 'position');
        $query = $this->_em->createNativeQuery($sql, $rsm);

        return $query->getSingleScalarResult();
    }
}

