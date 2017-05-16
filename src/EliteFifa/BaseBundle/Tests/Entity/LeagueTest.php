<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\League;
use EliteFifa\Bundle\Entity\LeagueStanding;
use EliteFifa\Bundle\Entity\Match;
use EliteFifa\Bundle\Tests\TestHelper;

class LeagueTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $league = new League();
        $league->setName("league1");

        $this->assertNotNull($league);
        $this->assertEquals("league1", $league->getName());
    }

    public function testDivision()
    {
        $league = new League();
        $league->setDivision(1);

        $this->assertNotNull($league);
        $this->assertEquals(1, $league->getDivision());
    }

    public function testAddStandings()
    {
        $standing1 = $this->createStanding("team1", 1);
        $standing2 = $this->createStanding("team2", 2);
        $standing3 = $this->createStanding("team3", 3);

        $league = TestHelper::createLeague("league1");
        $league->addStanding($standing1);
        $league->addStanding($standing2);
        $league->addStanding($standing3);

        $standings = $league->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(3, $standings->count());

        $this->assertTrue($league->hasStanding($standing1));
        $this->assertTrue($league->hasStanding($standing2));
        $this->assertTrue($league->hasStanding($standing3));
    }

    public function testAddStandingsBidirectional()
    {
        $standing1 = $this->createStanding("team1", 1);
        $standing2 = $this->createStanding("team2", 2);
        $standing3 = $this->createStanding("team3", 3);

        $league = TestHelper::createLeague("league1");
        $league->addStanding($standing1);
        $league->addStanding($standing2);
        $league->addStanding($standing3);

        $standings = $league->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(3, $standings->count());

        $this->assertTrue($league->hasStanding($standing1));
        $this->assertTrue($league->hasStanding($standing2));
        $this->assertTrue($league->hasStanding($standing3));

        $league = $standing1->getLeague();
        $this->assertNotNull($league);
        $this->assertEquals("league1", $league->getName());
    }

    public function testRemoveStandings()
    {
        $standing1 = $this->createStanding("team1", 1);
        $standing2 = $this->createStanding("team2", 2);
        $standing3 = $this->createStanding("team3", 3);

        $league = TestHelper::createLeague("league1");
        $league->addStanding($standing1);
        $league->addStanding($standing2);
        $league->addStanding($standing3);

        $standings = $league->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(3, $standings->count());

        $league->removeStanding($standing2);
        $standings = $league->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(2, $standings->count());
    }

    public function testAddMatches()
    {
        $match1 = $this->createMatch("team1", "team2");
        $match2 = $this->createMatch("team3", "team4");
        $match3 = $this->createMatch("team5", "team6");

        $league = new League();
        $league->setName("league1");
        $league->addMatch($match1);
        $league->addMatch($match2);
        $league->addMatch($match3);

        $matches = $league->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, $matches->count());
    }

    public function testAddMatchesBidirectional()
    {
        $match1 = $this->createMatch("team1", "team2");
        $match2 = $this->createMatch("team3", "team4");
        $match3 = $this->createMatch("team5", "team6");

        $league = new League();
        $league->setName("league1");
        $league->addMatch($match1);
        $league->addMatch($match2);
        $league->addMatch($match3);

        $matches = $league->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, $matches->count());

        $league = $matches->get(0)->getLeague();
        $this->assertNotNull($league);
        $this->assertEquals("league1", $league->getName());
    }

    public function testRemoveMatches()
    {
        $match1 = $this->createMatch("team1", "team2");
        $match2 = $this->createMatch("team3", "team4");
        $match3 = $this->createMatch("team5", "team6");

        $league = new League();
        $league->setName("league1");
        $league->addMatch($match1);
        $league->addMatch($match2);
        $league->addMatch($match3);

        $matches = $league->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, $matches->count());

        $league->removeMatch($match2);
        $matches = $league->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(2, $matches->count());
    }

    public function testRemoveMatchesBidirectional()
    {
        $match1 = $this->createMatch("team1", "team2");
        $match2 = $this->createMatch("team3", "team4");
        $match3 = $this->createMatch("team5", "team6");

        $league = new League();
        $league->setName("league1");
        $league->addMatch($match1);
        $league->addMatch($match2);
        $league->addMatch($match3);

        $matches = $league->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, $matches->count());

        $league = $match2->getLeague();
        $this->assertNotNull($league);
        $this->assertEquals("league1", $league->getName());

        $league->removeMatch($match2);
        $matches = $league->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(2, $matches->count());

        $league = $match2->getLeague();
        $this->assertNull($league);
    }

    private function createMatch($homeTeamName, $awayTeamName)
    {
        $homeTeam = TestHelper::createTeam($homeTeamName);
        $awayTeam = TestHelper::createTeam($awayTeamName);
        $match = TestHelper::createMatch($homeTeam, $awayTeam);
        return $match;
    }

    private function createStanding($teamName, $points)
    {
        $team = TestHelper::createTeam($teamName);
        $standing = TestHelper::createLeagueStanding($team, $points);
        return $standing;
    }
}