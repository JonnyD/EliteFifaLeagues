<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\Player;
use EliteFifa\Bundle\Entity\Match;
use EliteFifa\Bundle\Entity\Season;
use EliteFifa\Bundle\Tests\TestHelper;

class SeasonTest extends \PHPUnit_Framework_TestCase
{
    public function testNumber()
    {
        $season = new Season();
        $season->setNumber(1);

        $this->assertNotNull($season);
        $this->assertEquals(1, $season->getNumber());
    }

    public function testAddStandings()
    {
        $season = new Season();
        $season->setNumber(1);

        $standing1 = TestHelper::createLeagueStanding("liverpool", 3);
        $standing2 = TestHelper::createLeagueStanding("chelsea", 4);
        $standing3 = TestHelper::createLeagueStanding("arsenal", 2);

        $season->addStanding($standing1);
        $season->addStanding($standing2);
        $season->addStanding($standing3);

        $standings = $season->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(3, $standings->count());
    }

    public function testAddStandingsBidirectional()
    {
        $season = new Season();
        $season->setNumber(1);

        $standing1 = TestHelper::createLeagueStanding("liverpool", 3);
        $standing2 = TestHelper::createLeagueStanding("chelsea", 4);
        $standing3 = TestHelper::createLeagueStanding("arsenal", 2);

        $season->addStanding($standing1);
        $season->addStanding($standing2);
        $season->addStanding($standing3);

        $standings = $season->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(3, $standings->count());

        $season = $standings->get(0)->getSeason();
        $this->assertNotNull($season);
        $this->assertEquals(1, $season->getNumber());
    }

    public function testRemoveStandings()
    {
        $season = new Season();
        $season->setNumber(1);

        $standing1 = TestHelper::createLeagueStanding("liverpool", 3);
        $standing2 = TestHelper::createLeagueStanding("chelsea", 4);
        $standing3 = TestHelper::createLeagueStanding("arsenal", 2);

        $season->addStanding($standing1);
        $season->addStanding($standing2);
        $season->addStanding($standing3);

        $standings = $season->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(3, $standings->count());

        $season->removeStanding($standing2);
        $standings = $season->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(2, $standings->count());
    }

    public function testRemoveStandingsBidirectional()
    {
        $season = new Season();
        $season->setNumber(1);

        $standing1 = TestHelper::createLeagueStanding("liverpool", 3);
        $standing2 = TestHelper::createLeagueStanding("chelsea", 4);
        $standing3 = TestHelper::createLeagueStanding("arsenal", 2);

        $season->addStanding($standing1);
        $season->addStanding($standing2);
        $season->addStanding($standing3);

        $standings = $season->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(3, $standings->count());

        $season->removeStanding($standing2);
        $standings = $season->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(2, $standings->count());

        $season = $standing2->getSeason();
        $this->assertNull($season);
    }

    public function testAddMatches()
    {
        $season = new Season();
        $season->setNumber(1);

        $match1 = TestHelper::createMatch("liverpool", "chelsea");
        $match2 = TestHelper::createMatch("arsenal", "everton");
        $match3 = TestHelper::createMatch("man utd", "man city");

        $season->addMatch($match1);
        $season->addMatch($match2);
        $season->addMatch($match3);

        $matches = $season->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, $matches->count());
    }

    public function testAddMatchesBidirectional()
    {
        $season = new Season();
        $season->setNumber(1);

        $match1 = TestHelper::createMatch("liverpool", "chelsea");
        $match2 = TestHelper::createMatch("arsenal", "everton");
        $match3 = TestHelper::createMatch("man utd", "man city");

        $season->addMatch($match1);
        $season->addMatch($match2);
        $season->addMatch($match3);

        $matches = $season->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, $matches->count());

        $season = $match2->getSeason();
        $this->assertNotNull($season);
        $this->assertEquals(1, $season->getNumber());
    }

    public function testRemoveMatches()
    {
        $season = new Season();
        $season->setNumber(1);

        $match1 = TestHelper::createMatch("liverpool", "chelsea");
        $match2 = TestHelper::createMatch("arsenal", "everton");
        $match3 = TestHelper::createMatch("man utd", "man city");

        $season->addMatch($match1);
        $season->addMatch($match2);
        $season->addMatch($match3);

        $matches = $season->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, $matches->count());

        $season->removeMatch($match2);

        $matches = $season->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(2, $matches->count());
    }

    public function testRemoveMatchesBidirectional()
    {
        $season = new Season();
        $season->setNumber(1);

        $match1 = TestHelper::createMatch("liverpool", "chelsea");
        $match2 = TestHelper::createMatch("arsenal", "everton");
        $match3 = TestHelper::createMatch("man utd", "man city");

        $season->addMatch($match1);
        $season->addMatch($match2);
        $season->addMatch($match3);

        $matches = $season->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, $matches->count());

        $season->removeMatch($match2);

        $matches = $season->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(2, $matches->count());

        $season = $match2->getSeason();
        $this->assertNull($season);
    }

    public function testAddCompetition()
    {
        $season = TestHelper::createSeason(1);

        $competition1 = TestHelper::createCompetition("Competition 1");
        $competition2 = TestHelper::createCompetition("Competition 2");
        $competition3 = TestHelper::createCompetition("Competition 3");

        $season->addCompetition($competition1);
        $season->addCompetition($competition2);
        $season->addCompetition($competition3);

        $this->assertTrue($season->hasCompetition($competition1));
        $this->assertTrue($season->hasCompetition($competition2));
        $this->assertTrue($season->hasCompetition($competition3));

        $competitions = $season->getCompetitions();
        $this->assertNotNull($competitions);
        $this->assertEquals(3, count($competitions));
    }

    public function testAddCompetitionBidirectional()
    {
        $season = TestHelper::createSeason(1);

        $competition1 = TestHelper::createCompetition("Competition 1");
        $competition2 = TestHelper::createCompetition("Competition 2");
        $competition3 = TestHelper::createCompetition("Competition 3");

        $season->addCompetition($competition1);
        $season->addCompetition($competition2);
        $season->addCompetition($competition3);

        $this->assertTrue($season->hasCompetition($competition1));
        $this->assertTrue($season->hasCompetition($competition2));
        $this->assertTrue($season->hasCompetition($competition3));

        $competitions = $season->getCompetitions();
        $this->assertNotNull($competitions);
        $this->assertEquals(3, count($competitions));

        $season = $competitions->get(1)->getSeasons()->get(0);
        $this->assertNotNull($season);
        $this->assertEquals(1, $season->getNumber());
    }

    public function testRemoveCompetition()
    {
        $season = TestHelper::createSeason(1);

        $competition1 = TestHelper::createCompetition("Competition 1");
        $competition2 = TestHelper::createCompetition("Competition 2");
        $competition3 = TestHelper::createCompetition("Competition 3");

        $season->addCompetition($competition1);
        $season->addCompetition($competition2);
        $season->addCompetition($competition3);

        $this->assertTrue($season->hasCompetition($competition1));
        $this->assertTrue($season->hasCompetition($competition2));
        $this->assertTrue($season->hasCompetition($competition3));

        $competitions = $season->getCompetitions();
        $this->assertNotNull($competitions);
        $this->assertEquals(3, count($competitions));

        $season->removeCompetition($competition2);
        $this->assertFalse($season->hasCompetition($competition2));

        $competitions = $season->getCompetitions();
        $this->assertNotNull($competitions);
        $this->assertEquals(2, count($competitions));
    }

    public function testRemoveCompetitionBidirectional()
    {
        $season = TestHelper::createSeason(1);

        $competition1 = TestHelper::createCompetition("Competition 1");
        $competition2 = TestHelper::createCompetition("Competition 2");
        $competition3 = TestHelper::createCompetition("Competition 3");

        $season->addCompetition($competition1);
        $season->addCompetition($competition2);
        $season->addCompetition($competition3);

        $this->assertTrue($season->hasCompetition($competition1));
        $this->assertTrue($season->hasCompetition($competition2));
        $this->assertTrue($season->hasCompetition($competition3));

        $competitions = $season->getCompetitions();
        $this->assertNotNull($competitions);
        $this->assertEquals(3, count($competitions));

        $season->removeCompetition($competition2);
        $this->assertFalse($season->hasCompetition($competition2));

        $competitions = $season->getCompetitions();
        $this->assertNotNull($competitions);
        $this->assertEquals(2, count($competitions));

        $season = $competition2->getSeasons()->get(0);
        $this->assertNull($season);
    }
}