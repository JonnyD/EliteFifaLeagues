<?php

namespace EliteFifa\Bundle\Tests\Manager;

use EliteFifa\Bundle\Entity\League;
use EliteFifa\Bundle\Entity\LeagueStanding;
use EliteFifa\Bundle\Entity\Match;
use EliteFifa\Bundle\Entity\Season;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\User;
use EliteFifa\Bundle\Tests\BaseWebTestCase;

class LeagueManagerTest extends BaseWebTestCase
{
    private $leagueManager;
    private $seasonManager;
    private $teamManager;
    private $matchManager;

    public function setUp()
    {
        parent::setUp();

        $this->leagueManager = $this->getContainer()->get("elite_fifa.league_manager");
        $this->seasonManager = $this->getContainer()->get("elite_fifa.season_manager");
        $this->teamManager = $this->getContainer()->get("elite_fifa.team_manager");
        $this->matchManager = $this->getContainer()->get("elite_fifa.match_manager");
    }

    public function testGetLeagueByName()
    {
        $league = $this->leagueManager->getLeagueByName("Premier League");

        $this->assertNotNull($league);
        $this->assertEquals("Premier League", $league->getName());
    }

    public function testGetLeagueBySlug()
    {
        $league = $this->leagueManager->getLeagueBySlug("league-1");
        $this->assertNotNull($league);
        $this->assertEquals("League 1", $league->getName());
    }

    public function testGetStandingsByLeagueAndSeason()
    {
        $league = $this->leagueManager->getLeagueByName("Premier League");
        $season = $this->seasonManager->getCurrentSeasonForLeague($league);

        $standings = $this->leagueManager->getStandingsByLeagueAndSeason($league, $season);
        $this->assertNotNull($standings);
        $this->assertEquals(4, count($standings));
    }

    public function testGetStandingForTeam()
    {
        $team = $this->teamManager->getTeamByName("Liverpool");
        $league = $this->leagueManager->getLeagueByName("Premier League");
        $season = $this->seasonManager->getCurrentSeasonForLeague($league);

        $standing = $this->leagueManager->getStandingForTeam($team, $league, $season);
        $this->assertNotNull($standing);
        $this->assertEquals(1, count($standing));
    }

    public function testCreateStanding()
    {
        $team = $this->teamManager->getTeamByName("Liverpool");
        $league = $this->leagueManager->getLeagueByName("Premier League");
        $season = $this->seasonManager->getCurrentSeasonForLeague($league);

        $standing = $this->leagueManager->createStanding($team, $league, $season);
        $this->assertNotNull($standing);
        $this->assertEquals($team, $standing->getTeam());
        $this->assertEquals($league, $standing->getLeague());
        $this->assertEquals($season, $standing->getSeason());
    }

    public function testGetOrCreateStanding()
    {
        $team = $this->teamManager->getTeamByName("Liverpool");
        $league = $this->leagueManager->getLeagueByName("Premier League");
        $season = $this->seasonManager->getCurrentSeasonForLeague($league);

        $standing = $this->leagueManager->getOrCreateStanding($team, $league, $season);
        $this->assertNotNull($standing);
        $this->assertEquals($team, $standing->getTeam());
        $this->assertEquals($league, $standing->getLeague());
        $this->assertEquals($season, $standing->getSeason());
    }

    public function testUpdateStandingsByMatch()
    {
        $match = $this->matchManager->getUnreportedMatches()[0];
        $league = $this->leagueManager->getLeagueByName("Premier League");
        $season = $this->seasonManager->getCurrentSeasonForLeague($league);

        $this->checkMatch($match, $league, $season, "Chelsea", "Man City", "user3", "user4", null, null);

        $homeTeamStanding = $this->leagueManager->getStandingForTeam($match->getHomeTeam(), $league, $season);
        $this->checkStanding($homeTeamStanding, 5, 3, 2, 0, 10, 4, 6, 9);

        $awayTeamStanding = $this->leagueManager->getStandingForTeam($match->getAwayTeam(), $league, $season);
        $this->checkStanding($awayTeamStanding, 5, 2, 2, 1, 7, 8, -1, 7);

        $match->setHomeScore(2);
        $match->setAwayScore(0);
        $match->setReported(new \DateTime());
        $match->setConfirmed(new \DateTime());

        $this->leagueManager->updateStandingsByMatch($match);

        $this->checkMatch($match, $league, $season, "Chelsea", "Man City", "user3", "user4", 2, 0);

        $homeTeamStanding = $this->leagueManager->getStandingForTeam($match->getHomeTeam(), $league, $season);
        $this->checkStanding($homeTeamStanding, 6, 4, 2, 0, 12, 4, 8, 12);

        $awayTeamStanding = $this->leagueManager->getStandingForTeam($match->getAwayTeam(), $league, $season);
        $this->checkStanding($awayTeamStanding, 6, 2, 3, 1, 7, 10, -3, 7);
    }

    private function checkStanding(LeagueStanding $standing, $played, $won, $lost, $drawn,
                                  $goalsFor, $goalsAgainst, $goalDiff, $points)
    {
        $this->assertNotNull($standing);
        $this->assertEquals($played, $standing->getPlayed());
        $this->assertEquals($won, $standing->getWon());
        $this->assertEquals($lost, $standing->getLost());
        $this->assertEquals($drawn, $standing->getDrawn());
        $this->assertEquals($goalsFor, $standing->getGoalsFor());
        $this->assertEquals($goalsAgainst, $standing->getGoalsAgainst());
        $this->assertEquals($goalDiff, $standing->getGoalDifference());
        $this->assertEquals($points, $standing->getPoints());
    }

    private function checkMatch(Match $match, League $league, Season $season,
                                $homeTeam, $awayTeam, $homeUser,
                                $awayUser, $homeScore, $awayScore)
    {
        $this->assertNotNull($match);
        $this->assertEquals($homeTeam, $match->getHomeTeam()->getName());
        $this->assertEquals($awayTeam, $match->getAwayTeam()->getName());
        $this->assertEquals($homeUser, $match->getHomeUser()->getUsername());
        $this->assertEquals($awayUser, $match->getAwayUser()->getUsername());
        $this->assertEquals($league, $match->getLeague());
        $this->assertEquals($season, $match->getSeason());
        $this->assertEquals($homeScore, $match->getHomeScore());
        $this->assertEquals($awayScore, $match->getAwayScore());
    }
}