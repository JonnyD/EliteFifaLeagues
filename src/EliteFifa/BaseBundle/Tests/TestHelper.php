<?php

namespace EliteFifa\Bundle\Tests;

use EliteFifa\Bundle\Entity\Competition;
use EliteFifa\Bundle\Entity\Tournament;
use EliteFifa\Bundle\Entity\Goal;
use EliteFifa\Bundle\Entity\League;
use EliteFifa\Bundle\Entity\LeagueStanding;
use EliteFifa\Bundle\Entity\Match;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\Player;
use EliteFifa\Bundle\Entity\User;
use EliteFifa\Bundle\Entity\Role;
use EliteFifa\Bundle\Entity\Season;
use EliteFifa\Bundle\Entity\Stadium;
use EliteFifa\Bundle\Entity\Association;

class TestHelper
{
    public static function createTeam($name)
    {
        $team = new Team();
        $team->setName($name);
        return $team;
    }

    public static function createPlayer($name)
    {
        $player = new Player();
        $player->setName($name);
        return $player;
    }

    public static function createMatch($homeTeam, $awayTeam)
    {
        if (!TestHelper::isTeam($homeTeam)) {
            $homeTeam = TestHelper::createTeam($homeTeam);
        }
        if (!TestHelper::isTeam($awayTeam)) {
            $awayTeam = TestHelper::createTeam($awayTeam);
        }

        $match = new Match();
        $match->setHomeTeam($homeTeam);
        $match->setAwayTeam($awayTeam);
        return $match;
    }

    public static function createGoal($player)
    {
        $goal = new Goal();
        $goal->setPlayer($player);
        return $goal;
    }

    public static function createTestMatch()
    {
        $homeTeam = TestHelper::createTeam("Liverpool");
        $awayTeam = TestHelper::createTeam("Arsenal");
        $match = TestHelper::createMatch($homeTeam, $awayTeam);
        return $match;
    }

    public static function createUser($username)
    {
        $user = new User();
        $user->setUsername($username);
        return $user;
    }

    public static function createRole($name, $roleType)
    {
        $role = new Role();
        $role->setName($name);
        $role->setRole($roleType);
        return $role;
    }

    public static function createLeague($name)
    {
        $league = new League();
        $league->setName($name);
        return $league;
    }

    public static function createLeagueStanding($team, $points)
    {
        if (!($team instanceof Team)) {
            $team = TestHelper::createTeam($team);
        }

        $standing = new LeagueStanding();
        $standing->setTeam($team);
        $standing->setPoints($points);
        return $standing;
    }

    public static function createSeason($number)
    {
        $season = new Season();
        $season->setNumber($number);
        return $season;
    }

    public static function createStadium($name)
    {
        $stadium = new Stadium();
        $stadium->setName($name);
        return $stadium;
    }

    public static function createCompetition($name)
    {
        $competition = new Competition();
        $competition->setName($name);
        return $competition;
    }

    public static function createTournament($name)
    {
        $tournament = new Tournament();
        $tournament->setName($name);
        return $tournament;
    }

    public static function createAssociation($name)
    {
        $association = new Association();
        $association->setName($name);
        return $association;
    }

    private static function isTeam($team)
    {
        return $team instanceof Team;
    }
}