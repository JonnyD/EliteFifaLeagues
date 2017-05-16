<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\LeagueStanding;
use EliteFifa\Bundle\Tests\TestHelper;

class LeagueStandingTest extends \PHPUnit_Framework_TestCase
{
    public function testPlayed()
    {
        $standing = new LeagueStanding();
        $this->assertNotNull($standing);
        $this->assertEquals(0, $standing->getPlayed());

        $standing->setPlayed(10);
        $this->assertEquals(10, $standing->getPlayed());
    }

    public function testWon()
    {
        $standing = new LeagueStanding();
        $this->assertNotNull($standing);
        $this->assertEquals(0, $standing->getWon());

        $standing->setWon(10);
        $this->assertEquals(10, $standing->getWon());
    }

    public function testLost()
    {
        $standing = new LeagueStanding();
        $this->assertNotNull($standing);
        $this->assertEquals(0, $standing->getLost());

        $standing->setLost(10);
        $this->assertEquals(10, $standing->getLost());
    }

    public function testDrawn()
    {
        $standing = new LeagueStanding();
        $this->assertNotNull($standing);
        $this->assertEquals(0, $standing->getDrawn());

        $standing->setDrawn(10);
        $this->assertEquals(10, $standing->getDrawn());
    }

    public function testGoalsFor()
    {
        $standing = new LeagueStanding();
        $this->assertNotNull($standing);
        $this->assertEquals(0, $standing->getGoalsFor());

        $standing->setGoalsFor(10);
        $this->assertEquals(10, $standing->getGoalsFor());
    }

    public function testGoalsAgainst()
    {
        $standing = new LeagueStanding();
        $this->assertNotNull($standing);
        $this->assertEquals(0, $standing->getGoalsAgainst());

        $standing->setGoalsAgainst(10);
        $this->assertEquals(10, $standing->getGoalsAgainst());
    }

    public function testGoalDifference()
    {
        $standing = new LeagueStanding();
        $this->assertNotNull($standing);
        $this->assertEquals(0, $standing->getGoalDifference());

        $standing->setGoalsFor(20);
        $standing->setGoalsAgainst(10);
        $this->assertEquals(10, $standing->getGoalDifference());
    }

    public function testPoints()
    {
        $standing = new LeagueStanding();
        $this->assertNotNull($standing);
        $this->assertEquals(0, $standing->getLost());

        $standing->setLost(10);
        $this->assertEquals(10, $standing->getLost());
    }

    public function testLeague()
    {
        $league = TestHelper::createLeague("league1");

        $standing = new LeagueStanding();
        $standing->setPlayed(1);
        $standing->setPoints(3);
        $standing->setLeague($league);

        $this->assertNotNull($standing);
        $this->assertEquals("league1", $standing->getLeague()->getName());
    }

    public function testLeagueBidirectional()
    {
        $league = TestHelper::createLeague("league1");

        $standing = new LeagueStanding();
        $standing->setPlayed(1);
        $standing->setPoints(3);
        $standing->setLeague($league);

        $this->assertNotNull($standing);
        $this->assertEquals("league1", $standing->getLeague()->getName());

        $standing = $league->getStandings()->get(0);
        $this->assertNotNull($standing);
        $this->assertEquals(3, $standing->getPoints());
    }

    public function testRemoveLeague()
    {
        $league = TestHelper::createLeague("league1");

        $standing = new LeagueStanding();
        $standing->setPlayed(1);
        $standing->setPoints(3);
        $standing->setLeague($league);

        $this->assertNotNull($standing);
        $this->assertEquals("league1", $standing->getLeague()->getName());

        $standing->removeLeague();
        $this->assertNull($standing->getLeague());
    }

    public function testRemoveLeagueBidirectional()
    {
        $league = TestHelper::createLeague("league1");

        $standing = new LeagueStanding();
        $standing->setPlayed(1);
        $standing->setPoints(3);
        $standing->setLeague($league);

        $this->assertNotNull($standing);
        $this->assertEquals("league1", $standing->getLeague()->getName());

        $standing->removeLeague();
        $this->assertNull($standing->getLeague());

        $standings = $league->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(0, $standings->count());
    }

    public function testTeam()
    {
        $team1 = TestHelper::createTeam("team1");
        $standing = TestHelper::createLeagueStanding($team1, 3);

        $this->assertNotNull($standing);
        $this->assertEquals("team1", $standing->getTeam()->getName());
    }

    public function testTeamBidirectional()
    {
        $team1 = TestHelper::createTeam("team1");
        $standing = TestHelper::createLeagueStanding($team1, 3);

        $standing = $team1->getStandings()[0];
        $this->assertNotNull($standing);
        $this->assertEquals("team1", $standing->getTeam()->getName());
    }

    public function testRemoveTeam()
    {
        $team1 = TestHelper::createTeam("team1");
        $standing = TestHelper::createLeagueStanding($team1, 3);

        $this->assertNotNull($standing);
        $this->assertEquals("team1", $standing->getTeam()->getName());

        $standing->removeTeam();
        $this->assertNull($standing->getTeam());
    }

    public function testRemoveTeamBidirectional()
    {
        $team1 = TestHelper::createTeam("team1");
        $standing = TestHelper::createLeagueStanding($team1, 3);

        $this->assertNotNull($standing);
        $this->assertEquals("team1", $standing->getTeam()->getName());

        $standing->removeTeam();
        $this->assertNull($standing->getTeam());

        $standings = $team1->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(0, $standings->count());
    }

}