<?php

namespace EliteFifa\CompetitionBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use EliteFifa\Bundle\Entity\LeagueStanding;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\User;
use EliteFifa\Bundle\Entity\Competition;
use EliteFifa\Bundle\Entity\Season;

//TODO Clean queries, add Mapper Pattern/Hydrator, Specification Pattern?
class OldCompetitionRepository extends EntityRepository
{
    public function findStandingsByLeagueAndSeason($league, $season)
    {
        $sql = 'select * from ( select *, @rownum := @rownum + 1 AS position from (SELECT
	match_id,
	team.name AS team_name,
	team.id AS team_id,
	user.id AS user_id,
	user.username AS username,
	COUNT(*) AS played,
	SUM((CASE WHEN team_score > other_team_score THEN 1 ELSE 0 END)) AS won,
	SUM((CASE WHEN team_score < other_team_score THEN 1 ELSE 0 END)) AS lost,
	SUM((CASE WHEN team_score = other_team_score THEN 1 ELSE 0 END)) AS drawn,
	SUM(team_score) AS goals_for,
	SUM(other_team_score) AS goals_against,
	SUM(team_score - other_team_score) AS goal_difference,
	SUM((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1
	   	ELSE 0 END)) AS points,
	AVG((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1
	   	ELSE 0 END)) AS points_per_game,
	SUM((CASE WHEN other_team_score = 0 THEN 1 ELSE 0 END)) AS clean_sheets,
	SUM((CASE WHEN team_score = 0 THEN 1 ELSE 0 END)) AS failed_to_score,
	SUM((CASE WHEN home_away = "home" THEN 1 ELSE 0 END)) as home_played,
	SUM((CASE WHEN home_away = "away" THEN 1 ELSE 0 END)) as away_played,
	SUM((CASE WHEN home_away = "home" AND team_score > other_team_score THEN 1 ELSE 0 END)) as home_won,
	SUM((CASE WHEN home_away = "home" AND team_score = other_team_score THEN 1 ELSE 0 END)) as home_drawn,
	SUM((CASE WHEN home_away = "home" AND team_score < other_team_score THEN 1 ELSE 0 END)) as home_lost,
	SUM((CASE WHEN home_away = "away" AND team_score > other_team_score THEN 1 ELSE 0 END)) as away_won,
	SUM((CASE WHEN home_away = "away" AND team_score = other_team_score THEN 1 ELSE 0 END)) as away_drawn,
	SUM((CASE WHEN home_away = "away" AND team_score < other_team_score THEN 1 ELSE 0 END)) as away_lost,
	SUM((CASE WHEN home_away = "home" THEN team_score ELSE 0 END)) as home_goals_for,
	SUM((CASE WHEN home_away = "home" THEN other_team_score ELSE 0 END)) as home_goals_against,
	SUM((CASE WHEN home_away = "home" THEN team_score - other_team_score ELSE 0 END)) as home_goal_difference,
	SUM((CASE WHEN home_away = "away" THEN team_score ELSE 0 END)) as away_goals_for,
	SUM((CASE WHEN home_away = "away" THEN other_team_score ELSE 0 END)) as away_goals_against,
	SUM((CASE WHEN home_away = "away" THEN team_score - other_team_score ELSE 0 END)) as away_goal_difference,
	SUM((CASE WHEN team_score > 0 AND other_team_score > 0 THEN 1 ELSE 0 END)) as both_teams_scored
	FROM
	(
	-- LIST TEAM STATS WHEN PLAYED AS HOME_TEAM
	SELECT
	    id as match_id,
	    competition_id,
	    season_id,
	    home_team_id as team_id,
	    home_user_id as user_id,
	    home_score   as team_score,
	    away_score   as other_team_score,
	    confirmed,
	    "home" as home_away
	FROM matches
	UNION ALL
	-- LIST TEAM STATS WHEN PLAYED AS AWAY_TEAM
	SELECT
	    id as match_id,
	    competition_id,
	    season_id,
	    away_team_id as team_id,
	    away_user_id as user_id,
	    away_score   as team_score,
	    home_score   as other_team_score,
	    confirmed,
	    "away" as home_away
	FROM matches
	) matches
	INNER JOIN team ON matches.team_id = team.id
	INNER JOIN user ON matches.user_id = user.id
	WHERE competition_id = ?
	AND season_id = ?
	AND confirmed IS NOT NULL
	GROUP BY team.name, team_id
	ORDER BY POINTS DESC) x JOIN (SELECT @rownum := 0) r) y;';

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('team_id', 'teamId');
        $rsm->addScalarResult('team_name', 'teamName');
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
        $rsm->addScalarResult('points_per_game', 'ppg');
        $rsm->addScalarResult('clean_sheets', 'cleanSheets');
        $rsm->addScalarResult('failed_to_score', 'failedToScore');
        $rsm->addScalarResult('position', 'position');
        $rsm->addScalarResult('home_played', 'homePlayed');
        $rsm->addScalarResult('away_played', 'awayPlayed');
        $rsm->addScalarResult('home_won', 'homeWon');
        $rsm->addScalarResult('home_drawn', 'homeDrawn');
        $rsm->addScalarResult('home_lost', 'homeLost');
        $rsm->addScalarResult('away_won', 'awayWon');
        $rsm->addScalarResult('away_drawn', 'awayDrawn');
        $rsm->addScalarResult('away_lost', 'awayLost');
        $rsm->addScalarResult('home_goals_for', 'homeGoalsFor');
        $rsm->addScalarResult('home_goals_against', 'homeGoalsAgainst');
        $rsm->addScalarResult('home_goal_difference', 'homeGoalDifference');
        $rsm->addScalarResult('away_goals_for', 'awayGoalsFor');
        $rsm->addScalarResult('away_goals_against', 'awayGoalsAgainst');
        $rsm->addScalarResult('away_goal_difference', 'awayGoalDifference');
        $rsm->addScalarResult('both_teams_scored', 'bothTeamsScored');

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $league->getId());
        $query->setParameter(2, $season->getId());
        $results = $query->getResult();

        return $results;
    }

    public function findHomeStandingsByCompetitionAndSeason($competition, $season)
    {
        $sql = 'select * from ( select *, @rownum := @rownum + 1 AS position from (SELECT
	match_id,
	team.name AS team_name,
	team.id AS team_id,
	user.id AS user_id,
	user.username AS username,
	COUNT(*) AS played,
	SUM((CASE WHEN team_score > other_team_score THEN 1 ELSE 0 END)) AS won,
	SUM((CASE WHEN team_score < other_team_score THEN 1 ELSE 0 END)) AS lost,
	SUM((CASE WHEN team_score = other_team_score THEN 1 ELSE 0 END)) AS drawn,
	SUM(team_score) AS goals_for,
	SUM(other_team_score) AS goals_against,
	SUM(team_score - other_team_score) AS goal_difference,
	SUM((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1
	   	ELSE 0 END)) AS points,
	AVG((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1
	   	ELSE 0 END)) AS points_per_game,
	SUM((CASE WHEN other_team_score = 0 THEN 1 ELSE 0 END)) AS clean_sheets,
	SUM((CASE WHEN team_score = 0 THEN 1 ELSE 0 END)) AS failed_to_score,
	SUM((CASE WHEN home_away = "home" THEN 1 ELSE 0 END)) as home_played,
	SUM((CASE WHEN home_away = "away" THEN 1 ELSE 0 END)) as away_played,
	SUM((CASE WHEN home_away = "home" AND team_score > other_team_score THEN 1 ELSE 0 END)) as home_won,
	SUM((CASE WHEN home_away = "home" AND team_score = other_team_score THEN 1 ELSE 0 END)) as home_drawn,
	SUM((CASE WHEN home_away = "home" AND team_score < other_team_score THEN 1 ELSE 0 END)) as home_lost,
	SUM((CASE WHEN home_away = "away" AND team_score > other_team_score THEN 1 ELSE 0 END)) as away_won,
	SUM((CASE WHEN home_away = "away" AND team_score = other_team_score THEN 1 ELSE 0 END)) as away_drawn,
	SUM((CASE WHEN home_away = "away" AND team_score < other_team_score THEN 1 ELSE 0 END)) as away_lost,
	SUM((CASE WHEN home_away = "home" THEN team_score ELSE 0 END)) as home_goals_for,
	SUM((CASE WHEN home_away = "home" THEN other_team_score ELSE 0 END)) as home_goals_against,
	SUM((CASE WHEN home_away = "home" THEN team_score - other_team_score ELSE 0 END)) as home_goal_difference,
	SUM((CASE WHEN home_away = "away" THEN team_score ELSE 0 END)) as away_goals_for,
	SUM((CASE WHEN home_away = "away" THEN other_team_score ELSE 0 END)) as away_goals_against,
	SUM((CASE WHEN home_away = "away" THEN team_score - other_team_score ELSE 0 END)) as away_goal_difference,
	SUM((CASE WHEN home_away = "home" AND team_score > other_team_score THEN 3
	          WHEN team_score = other_team_score THEN 1
              ELSE 0 END)) as home_points,
    SUM((CASE WHEN home_away = "away" AND team_score > other_team_score THEN 3
              WHEN team_score = other_team_score THEN 1
              ELSE 0 END)) as away_points,
	SUM((CASE WHEN team_score > 0 AND other_team_score > 0 THEN 1 ELSE 0 END)) as both_teams_scored
	FROM
	(
	-- LIST TEAM STATS WHEN PLAYED AS HOME_TEAM
	SELECT
	    id as match_id,
	    competition_id,
	    season_id,
	    home_team_id as team_id,
	    home_user_id as user_id,
	    home_score   as team_score,
	    away_score   as other_team_score,
	    confirmed,
	    "home" as home_away
	FROM matches
	UNION ALL
	-- LIST TEAM STATS WHEN PLAYED AS AWAY_TEAM
	SELECT
	    id as match_id,
	    competition_id,
	    season_id,
	    away_team_id as team_id,
	    away_user_id as user_id,
	    away_score   as team_score,
	    home_score   as other_team_score,
	    confirmed,
	    "away" as home_away
	FROM matches
	) matches
	INNER JOIN team ON matches.team_id = team.id
	INNER JOIN user ON matches.user_id = user.id
	WHERE competition_id = ?
	AND season_id = ?
	AND confirmed IS NOT NULL
	GROUP BY team.name, team_id
	ORDER BY home_points DESC) x JOIN (SELECT @rownum := 0) r) y;';

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('team_id', 'teamId');
        $rsm->addScalarResult('team_name', 'teamName');
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
        $rsm->addScalarResult('points_per_game', 'ppg');
        $rsm->addScalarResult('clean_sheets', 'cleanSheets');
        $rsm->addScalarResult('failed_to_score', 'failedToScore');
        $rsm->addScalarResult('position', 'position');
        $rsm->addScalarResult('home_played', 'homePlayed');
        $rsm->addScalarResult('away_played', 'awayPlayed');
        $rsm->addScalarResult('home_won', 'homeWon');
        $rsm->addScalarResult('home_drawn', 'homeDrawn');
        $rsm->addScalarResult('home_lost', 'homeLost');
        $rsm->addScalarResult('away_won', 'awayWon');
        $rsm->addScalarResult('away_drawn', 'awayDrawn');
        $rsm->addScalarResult('away_lost', 'awayLost');
        $rsm->addScalarResult('home_goals_for', 'homeGoalsFor');
        $rsm->addScalarResult('home_goals_against', 'homeGoalsAgainst');
        $rsm->addScalarResult('home_goal_difference', 'homeGoalDifference');
        $rsm->addScalarResult('away_goals_for', 'awayGoalsFor');
        $rsm->addScalarResult('away_goals_against', 'awayGoalsAgainst');
        $rsm->addScalarResult('away_goal_difference', 'awayGoalDifference');
        $rsm->addScalarResult('home_points', 'homePoints');
        $rsm->addScalarResult('away_points', 'awayPoints');
        $rsm->addScalarResult('both_teams_scored', 'bothTeamsScored');

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $competition->getId());
        $query->setParameter(2, $season->getId());
        $results = $query->getResult();

        $standings = array();
        foreach ($results as $result)
        {
            $standing = new LeagueStanding();
            $standing->setPlayed($result["played"]);
            $standing->setWon($result["won"]);
            $standing->setLost($result["lost"]);
            $standing->setDrawn($result["drawn"]);
            $standing->setGoalsFor($result["goalsFor"]);
            $standing->setGoalsAgainst($result["goalsAgainst"]);
            $standing->setPoints($result["points"]);
            $standing->setPointsPerGame($result["ppg"]);
            $standing->setCleanSheets($result["cleanSheets"]);
            $standing->setFailedToScore($result["failedToScore"]);
            $standing->setPosition($result["position"]);
            $standing->setHomePlayed($result["homePlayed"]);
            $standing->setAwayPlayed($result["awayPlayed"]);
            $standing->setHomeWon($result["homeWon"]);
            $standing->setHomeDrawn($result["homeDrawn"]);
            $standing->setHomeLost($result["homeLost"]);
            $standing->setAwayWon($result["awayWon"]);
            $standing->setAwayDrawn($result["awayDrawn"]);
            $standing->setAwayLost($result["awayLost"]);
            $standing->setHomeGoalsAgainst($result["homeGoalsAgainst"]);
            $standing->setHomeGoalsFor($result["homeGoalsFor"]);
            $standing->setHomeGoalDifference($result["homeGoalDifference"]);
            $standing->setAwayGoalsAgainst($result["awayGoalsAgainst"]);
            $standing->setAwayGoalsFor($result["awayGoalsFor"]);
            $standing->setAwayGoalDifference($result["awayGoalDifference"]);
            $standing->setHomePoints($result["homePoints"]);
            $standing->setAwayPoints($result["awayPoints"]);
            $standing->setBothTeamsScored($result["bothTeamsScored"]);

            $team = new Team();
            $team->setId($result["teamId"]);
            $standing->setTeam($team);

            $user = new User();
            $user->setId($result["userId"]);
            $standing->setUser($user);

            $standings[] = $standing;
        }

        return $standings;
    }

    public function findAwayStandingsByCompetitionAndSeason($competition, $season)
    {
        $sql = 'select * from ( select *, @rownum := @rownum + 1 AS position from (SELECT
	match_id,
	team.name AS team_name,
	team.id AS team_id,
	user.id AS user_id,
	user.username AS username,
	COUNT(*) AS played,
	SUM((CASE WHEN team_score > other_team_score THEN 1 ELSE 0 END)) AS won,
	SUM((CASE WHEN team_score < other_team_score THEN 1 ELSE 0 END)) AS lost,
	SUM((CASE WHEN team_score = other_team_score THEN 1 ELSE 0 END)) AS drawn,
	SUM(team_score) AS goals_for,
	SUM(other_team_score) AS goals_against,
	SUM(team_score - other_team_score) AS goal_difference,
	SUM((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1
	   	ELSE 0 END)) AS points,
	AVG((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1
	   	ELSE 0 END)) AS points_per_game,
	SUM((CASE WHEN other_team_score = 0 THEN 1 ELSE 0 END)) AS clean_sheets,
	SUM((CASE WHEN team_score = 0 THEN 1 ELSE 0 END)) AS failed_to_score,
	SUM((CASE WHEN home_away = "home" THEN 1 ELSE 0 END)) as home_played,
	SUM((CASE WHEN home_away = "away" THEN 1 ELSE 0 END)) as away_played,
	SUM((CASE WHEN home_away = "home" AND team_score > other_team_score THEN 1 ELSE 0 END)) as home_won,
	SUM((CASE WHEN home_away = "home" AND team_score = other_team_score THEN 1 ELSE 0 END)) as home_drawn,
	SUM((CASE WHEN home_away = "home" AND team_score < other_team_score THEN 1 ELSE 0 END)) as home_lost,
	SUM((CASE WHEN home_away = "away" AND team_score > other_team_score THEN 1 ELSE 0 END)) as away_won,
	SUM((CASE WHEN home_away = "away" AND team_score = other_team_score THEN 1 ELSE 0 END)) as away_drawn,
	SUM((CASE WHEN home_away = "away" AND team_score < other_team_score THEN 1 ELSE 0 END)) as away_lost,
	SUM((CASE WHEN home_away = "home" THEN team_score ELSE 0 END)) as home_goals_for,
	SUM((CASE WHEN home_away = "home" THEN other_team_score ELSE 0 END)) as home_goals_against,
	SUM((CASE WHEN home_away = "home" THEN team_score - other_team_score ELSE 0 END)) as home_goal_difference,
	SUM((CASE WHEN home_away = "away" THEN team_score ELSE 0 END)) as away_goals_for,
	SUM((CASE WHEN home_away = "away" THEN other_team_score ELSE 0 END)) as away_goals_against,
	SUM((CASE WHEN home_away = "away" THEN team_score - other_team_score ELSE 0 END)) as away_goal_difference,
	SUM((CASE WHEN home_away = "home" AND team_score > other_team_score THEN 3
	          WHEN team_score = other_team_score THEN 1
              ELSE 0 END)) as home_points,
    SUM((CASE WHEN home_away = "away" AND team_score > other_team_score THEN 3
              WHEN team_score = other_team_score THEN 1
              ELSE 0 END)) as away_points,
	SUM((CASE WHEN team_score > 0 AND other_team_score > 0 THEN 1 ELSE 0 END)) as both_teams_scored
	FROM
	(
	-- LIST TEAM STATS WHEN PLAYED AS HOME_TEAM
	SELECT
	    id as match_id,
	    competition_id,
	    season_id,
	    home_team_id as team_id,
	    home_user_id as user_id,
	    home_score   as team_score,
	    away_score   as other_team_score,
	    confirmed,
	    "home" as home_away
	FROM matches
	UNION ALL
	-- LIST TEAM STATS WHEN PLAYED AS AWAY_TEAM
	SELECT
	    id as match_id,
	    competition_id,
	    season_id,
	    away_team_id as team_id,
	    away_user_id as user_id,
	    away_score   as team_score,
	    home_score   as other_team_score,
	    confirmed,
	    "away" as home_away
	FROM matches
	) matches
	INNER JOIN team ON matches.team_id = team.id
	INNER JOIN user ON matches.user_id = user.id
	WHERE competition_id = ?
	AND season_id = ?
	AND confirmed IS NOT NULL
	GROUP BY team.name, team_id
	ORDER BY away_points DESC) x JOIN (SELECT @rownum := 0) r) y;';

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('team_id', 'teamId');
        $rsm->addScalarResult('team_name', 'teamName');
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
        $rsm->addScalarResult('points_per_game', 'ppg');
        $rsm->addScalarResult('clean_sheets', 'cleanSheets');
        $rsm->addScalarResult('failed_to_score', 'failedToScore');
        $rsm->addScalarResult('position', 'position');
        $rsm->addScalarResult('home_played', 'homePlayed');
        $rsm->addScalarResult('away_played', 'awayPlayed');
        $rsm->addScalarResult('home_won', 'homeWon');
        $rsm->addScalarResult('home_drawn', 'homeDrawn');
        $rsm->addScalarResult('home_lost', 'homeLost');
        $rsm->addScalarResult('away_won', 'awayWon');
        $rsm->addScalarResult('away_drawn', 'awayDrawn');
        $rsm->addScalarResult('away_lost', 'awayLost');
        $rsm->addScalarResult('home_goals_for', 'homeGoalsFor');
        $rsm->addScalarResult('home_goals_against', 'homeGoalsAgainst');
        $rsm->addScalarResult('home_goal_difference', 'homeGoalDifference');
        $rsm->addScalarResult('away_goals_for', 'awayGoalsFor');
        $rsm->addScalarResult('away_goals_against', 'awayGoalsAgainst');
        $rsm->addScalarResult('away_goal_difference', 'awayGoalDifference');
        $rsm->addScalarResult('home_points', 'homePoints');
        $rsm->addScalarResult('away_points', 'awayPoints');
        $rsm->addScalarResult('both_teams_scored', 'bothTeamsScored');

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $competition->getId());
        $query->setParameter(2, $season->getId());
        $results = $query->getResult();

        $standings = array();
        foreach ($results as $result)
        {
            $standing = new LeagueStanding();
            $standing->setPlayed($result["played"]);
            $standing->setWon($result["won"]);
            $standing->setLost($result["lost"]);
            $standing->setDrawn($result["drawn"]);
            $standing->setGoalsFor($result["goalsFor"]);
            $standing->setGoalsAgainst($result["goalsAgainst"]);
            $standing->setPoints($result["points"]);
            $standing->setPointsPerGame($result["ppg"]);
            $standing->setCleanSheets($result["cleanSheets"]);
            $standing->setFailedToScore($result["failedToScore"]);
            $standing->setPosition($result["position"]);
            $standing->setHomePlayed($result["homePlayed"]);
            $standing->setAwayPlayed($result["awayPlayed"]);
            $standing->setHomeWon($result["homeWon"]);
            $standing->setHomeDrawn($result["homeDrawn"]);
            $standing->setHomeLost($result["homeLost"]);
            $standing->setAwayWon($result["awayWon"]);
            $standing->setAwayDrawn($result["awayDrawn"]);
            $standing->setAwayLost($result["awayLost"]);
            $standing->setHomeGoalsAgainst($result["homeGoalsAgainst"]);
            $standing->setHomeGoalsFor($result["homeGoalsFor"]);
            $standing->setHomeGoalDifference($result["homeGoalDifference"]);
            $standing->setAwayGoalsAgainst($result["awayGoalsAgainst"]);
            $standing->setAwayGoalsFor($result["awayGoalsFor"]);
            $standing->setAwayGoalDifference($result["awayGoalDifference"]);
            $standing->setHomePoints($result["homePoints"]);
            $standing->setAwayPoints($result["awayPoints"]);
            $standing->setBothTeamsScored($result["bothTeamsScored"]);

            $team = new Team();
            $team->setId($result["teamId"]);
            $standing->setTeam($team);

            $user = new User();
            $user->setId($result["userId"]);
            $standing->setUser($user);

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
                         competition_id,
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
                         competition_id,
                         season_id,
                         away_user_id as user_id,
                         away_score   as team_score,
                         home_score   as other_team_score,
                         confirmed
                    FROM matches
                ) matches
            INNER JOIN user ON matches.user_id = user.id
            WHERE competition_id = ?
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

    public function findTeamStandingsByRoundLeagueSeason($team, $round, $league, $season)
    {
        $sql = 'SELECT * FROM (
SELECT *, @rownum := @rownum + 1 AS position FROM (
SELECT
	match_id,
	team.name AS team_name,
	team.id AS team_id,
	user.id AS user_id,
	user.username AS username,
	COUNT(*) AS played,
	SUM((CASE WHEN team_score > other_team_score THEN 1 ELSE 0 END)) AS won,
	SUM((CASE WHEN team_score < other_team_score THEN 1 ELSE 0 END)) AS lost,
	SUM((CASE WHEN team_score = other_team_score THEN 1 ELSE 0 END)) AS drawn,
	SUM(team_score) AS goals_for,
	SUM(other_team_score) AS goals_against,
	SUM(team_score - other_team_score) AS goal_difference,
	SUM((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1
	   	ELSE 0 END)) AS points,
	AVG((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1

	   	ELSE 0 END)) AS ppg,
	SUM((CASE WHEN other_team_score = 0 THEN 1 ELSE 0 END)) AS clean_sheets,
	SUM((CASE WHEN team_score = 0 THEN 1 ELSE 0 END)) AS failed_to_score


	FROM
	(
	-- LIST TEAM STATS WHEN PLAYED AS HOME_TEAM


	SELECT
	    id as match_id,
	    competition_id,
        round as round,
	    season_id,
	    home_team_id as team_id,
	    home_user_id as user_id,
	    home_score   as team_score,
	    away_score   as other_team_score,



	    confirmed
	FROM matches
	UNION ALL
	-- LIST TEAM STATS WHEN PLAYED AS AWAY_TEAM


	SELECT
	    id as match_id,
	    competition_id,
        round as round,
	    season_id,
	    away_team_id as team_id,
	    away_user_id as user_id,
	    away_score   as team_score,
	    home_score   as other_team_score,

	    confirmed
	FROM matches

	) matches
	INNER JOIN team ON matches.team_id = team.id
	INNER JOIN user ON matches.user_id = user.id
	WHERE round <= ?
	AND competition_id = ?
	AND season_id = ?
	AND confirmed IS NOT NULL
	GROUP BY team.name, team_id
	ORDER BY POINTS DESC) x JOIN (SELECT @rownum := 0) r) y
	WHERE team_id = ?';

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('team_id', 'teamId');
        $rsm->addScalarResult('team_name', 'teamName');
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
        $rsm->addScalarResult('ppg', 'ppg');
        $rsm->addScalarResult('clean_sheets', 'cleanSheets');
        $rsm->addScalarResult('failed_to_score', 'failedToScore');
        $rsm->addScalarResult('position', 'position');

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $round);
        $query->setParameter(2, $league->getId());
        $query->setParameter(3, $season->getId());
        $query->setParameter(4, $team->getId());
        $results = $query->getOneOrNullResult();

        return $results;
    }


    public function findTeamStandingsByMatchLeagueSeason($team, $match, $league, $season)
    {
        $sql = 'SELECT * FROM (
SELECT *, @rownum := @rownum + 1 AS position FROM (
SELECT
	match_id,
	team.name AS team_name,
	team.id AS team_id,
	user.id AS user_id,
	user.username AS username,
	COUNT(*) AS played,
	SUM((CASE WHEN team_score > other_team_score THEN 1 ELSE 0 END)) AS won,
	SUM((CASE WHEN team_score < other_team_score THEN 1 ELSE 0 END)) AS lost,
	SUM((CASE WHEN team_score = other_team_score THEN 1 ELSE 0 END)) AS drawn,
	SUM(team_score) AS goals_for,
	SUM(other_team_score) AS goals_against,
	SUM(team_score - other_team_score) AS goal_difference,
	SUM((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1
	   	ELSE 0 END)) AS points,
	AVG((CASE WHEN team_score > other_team_score THEN 3
		WHEN team_score = other_team_score THEN 1

	   	ELSE 0 END)) AS ppg,
	SUM((CASE WHEN other_team_score = 0 THEN 1 ELSE 0 END)) AS clean_sheets,
	SUM((CASE WHEN team_score = 0 THEN 1 ELSE 0 END)) AS failed_to_score


	FROM
	(
	-- LIST TEAM STATS WHEN PLAYED AS HOME_TEAM


	SELECT
	    id as match_id,
	    competition_id,
        round as round,
	    season_id,
	    home_team_id as team_id,
	    home_user_id as user_id,
	    home_score   as team_score,
	    away_score   as other_team_score,
	    confirmed as confirmed
	FROM matches
	UNION ALL
	-- LIST TEAM STATS WHEN PLAYED AS AWAY_TEAM


	SELECT
	    id as match_id,
	    competition_id,
        round as round,
	    season_id,
	    away_team_id as team_id,
	    away_user_id as user_id,
	    away_score   as team_score,
	    home_score   as other_team_score,
	    confirmed as confirmed
	FROM matches
	) matches
	INNER JOIN team ON matches.team_id = team.id
	INNER JOIN user ON matches.user_id = user.id
	WHERE confirmed <= ?
	AND competition_id = ?
	AND season_id = ?
	AND confirmed IS NOT NULL
	GROUP BY team.name, team_id
	ORDER BY POINTS DESC) x JOIN (SELECT @rownum := 0) r) y
	WHERE team_id = ?';

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('team_id', 'teamId');
        $rsm->addScalarResult('team_name', 'teamName');
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
        $rsm->addScalarResult('ppg', 'ppg');
        $rsm->addScalarResult('clean_sheets', 'cleanSheets');
        $rsm->addScalarResult('failed_to_score', 'failedToScore');
        $rsm->addScalarResult('position', 'position');

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $match->getConfirmed());
        $query->setParameter(2, $league->getId());
        $query->setParameter(3, $season->getId());
        $query->setParameter(4, $team->getId());
        $results = $query->getOneOrNullResult();

        return $results;
    }

    public function findRelegatedTeamsByCompetitionAndSeason(Competition $competition, Season $season)
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
                         competition_id,
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
                         competition_id,
                         season_id,
                         away_team_id as team_id,
                         away_score   as team_score,
                         home_score   as other_team_score,
                         confirmed
                    FROM matches
                ) matches
            INNER JOIN team ON matches.team_id = team.id
            WHERE competition_id = ?
                AND season_id = ?
                AND confirmed IS NOT NULL
            GROUP BY team.name, team_id
            ORDER BY points ASC
            LIMIT ?';

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
        $query->setParameter(1, $competition->getId());
        $query->setParameter(2, $season->getId());
        $query->setParameter(3, $competition->getRelegationSpots());
        $results = $query->getResult();

        $teams = array();
        foreach ($results as $result) {
            $team = new Team();
            $team->setId($result["teamId"]);
            $team->setName($result["teamName"]);

            $teams[] = $team;
        }

        return $teams;
    }

    public function findPromotedTeamsByCompetitionAndSeason(Competition $competition, Season $season)
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
                         competition_id,
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
                         competition_id,
                         season_id,
                         away_team_id as team_id,
                         away_score   as team_score,
                         home_score   as other_team_score,
                         confirmed
                    FROM matches
                ) matches
            INNER JOIN team ON matches.team_id = team.id
            WHERE competition_id = ?
                AND season_id = ?
                AND confirmed IS NOT NULL
            GROUP BY team.name, team_id
            ORDER BY points DESC
            LIMIT ?';

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
        $query->setParameter(1, $competition->getId());
        $query->setParameter(2, $season->getId());
        $query->setParameter(3, $competition->getPromotionSpots());
        $results = $query->getResult();

        $teams = array();
        foreach ($results as $result) {
            $team = new Team();
            $team->setId($result["teamId"]);
            $team->setName($result["teamName"]);

            $teams[] = $team;
        }

        return $teams;
    }
}

