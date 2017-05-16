<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\Player;
use EliteFifa\Bundle\Entity\Match;
use EliteFifa\Bundle\Entity\User;
use EliteFifa\Bundle\Tests\TestHelper;

class TeamTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $team = TestHelper::createTeam("Liverpool");

        $this->assertNotNull($team);
        $this->assertEquals("Liverpool", $team->getName());
    }

    public function testPlayers()
    {
        $team = TestHelper::createTeam("Liverpool");
        $players = $team->getPlayers();

        $this->assertNotNull($players);
        $this->assertTrue($players->isEmpty());
        $this->assertEquals(0, $players->count());
    }

    public function testAddPlayers()
    {
        $team = TestHelper::createTeam("Liverpool");

        $suarez = TestHelper::createPlayer("Suarez");
        $team->addPlayer($suarez);

        $gerrard = TestHelper::createPlayer("Gerrard");
        $team->addPlayer($gerrard);

        $sturridge = TestHelper::createPlayer("Sturridge");
        $team->addPlayer($sturridge);

        $players = $team->getPlayers();

        $this->assertNotNull($players);
        $this->assertFalse($players->isEmpty());
        $this->assertEquals(3, $players->count());
    }

    public function testRemovePlayers()
    {
        $team = TestHelper::createTeam("Liverpool");

        $suarez = TestHelper::createPlayer("Suarez");
        $team->addPlayer($suarez);

        $gerrard = TestHelper::createPlayer("Gerrard");
        $team->addPlayer($gerrard);

        $players = $team->getPlayers();
        $this->assertNotNull($players);
        $this->assertFalse($players->isEmpty());
        $this->assertTrue(is_array($players->toArray()));
        $this->assertTrue(isset($players->toArray()[0]));
        $this->assertTrue(isset($players->toArray()[1]));
        $this->assertEquals(2, $players->count());

        $team->removePlayer($suarez);

        $players2 = $team->getPlayers();
        $this->assertNotNull($players2);
        $this->assertFalse($players->isEmpty());
        $this->assertTrue(is_array($players2->toArray()));
        $this->assertTrue(isset($players2->toArray()[1]));
        $this->assertEquals(1, $players2->count());

        $gerrard2 = $players2->toArray()[1];
        $this->assertNotNull($gerrard2);
        $this->assertEquals("Gerrard", $gerrard2->getName());
    }

    public function testPlayersBidirectional()
    {
        $team = TestHelper::createTeam("Liverpool");

        $suarez = new Player();
        $suarez->setName("Suarez");
        $team->addPlayer($suarez);

        $gerrard = new Player();
        $gerrard->setName("Gerrard");
        $team->addPlayer($gerrard);

        $players = $team->getPlayers();
        $this->assertNotNull($players);

        $player1Team = $players[0]->getTeam();
        $this->assertNotNull($player1Team);
        $this->assertEquals("Liverpool", $player1Team->getName());
    }

    public function testHomeMatches()
    {
        $team = TestHelper::createTeam("Liverpool");
        $homeMatches = $team->getHomeMatches();

        $this->assertNotNull($homeMatches);
        $this->assertTrue($homeMatches->isEmpty());
        $this->assertEquals(0, $homeMatches->count());
    }

    public function testAddHomeMatch()
    {
        $homeTeam = TestHelper::createTeam("Liverpool");
        $awayTeam = TestHelper::createTeam("Arsenal");
        $match = TestHelper::createMatch($homeTeam, $awayTeam);

        $homeTeam->addHomeMatch($match);

        $liverpoolHomeMatches = $homeTeam->getHomeMatches();
        $this->checkMatches($liverpoolHomeMatches);

        $arsenalAwayMatches = $awayTeam->getAwayMatches();
        $this->checkMatches($arsenalAwayMatches);
    }

    public function testRemoveHomeMatch()
    {
        $liverpool =  TestHelper::createTeam("Liverpool");
        $arsenal = TestHelper::createTeam("Arsenal");
        $match = TestHelper::createMatch($liverpool, $arsenal);

        $liverpoolHomeMatches = $liverpool->getHomeMatches();
        $this->checkMatches($liverpoolHomeMatches);

        $liverpool->removeHomeMatch($match);

        $liverpoolHomeMatches2 = $liverpool->getHomeMatches();
        $this->assertNotNull($liverpoolHomeMatches2);
        $this->assertTrue($liverpoolHomeMatches2->isEmpty());
        $this->assertEquals(0, $liverpoolHomeMatches2->count());
    }

    public function testAwayMatches()
    {
        $team = TestHelper::createTeam("Liverpool");
        $awayMatches = $team->getAwayMatches();

        $this->assertNotNull($awayMatches);
        $this->assertTrue($awayMatches->isEmpty());
        $this->assertEquals(0, $awayMatches->count());
    }

    public function testAddAwayMatch()
    {
        $homeTeam = TestHelper::createTeam("Liverpool");
        $awayTeam = TestHelper::createTeam("Arsenal");
        $match = TestHelper::createMatch($homeTeam, $awayTeam);

        $awayTeam->addAwayMatch($match);

        $arsenalAwayMatches = $awayTeam->getAwayMatches();
        $this->checkMatches($arsenalAwayMatches);

        $liverpoolHomeMatches = $homeTeam->getHomeMatches();
        $this->checkMatches($liverpoolHomeMatches);
    }

    public function testRemoveAwayMatch()
    {
        $homeTeam = TestHelper::createTeam("Liverpool");
        $awayTeam = TestHelper::createTeam("Arsenal");
        $match = TestHelper::createMatch($homeTeam, $awayTeam);

        $awayTeam->addAwayMatch($match);

        $awayMatches = $awayTeam->getAwayMatches();
        $this->checkMatches($awayMatches);

        $awayTeam->removeAwayMatch($match);

        $awayMatches2 = $awayTeam->getAwayMatches();
        $this->assertNotNull($awayMatches2);
        $this->assertTrue($awayMatches2->isEmpty());
        $this->assertEquals(0, $awayMatches2->count());
    }

    public function testUser()
    {
        $user = TestHelper::createUser("user1");
        $team = TestHelper::createTeam("Liverpool");
        $team->setUser($user);

        $this->assertNotNull($team->getUser());
        $this->assertEquals("user1", $team->getUser()->getUsername());
    }

    public function testAddStandings()
    {
        $team1 = TestHelper::createTeam("team1");
        $season1 = TestHelper::createSeason(1);
        $season2 = TestHelper::createSeason(2);
        $league = TestHelper::createLeague("EPL");

        $standing1 = TestHelper::createLeagueStanding($team1, 1);
        $standing1->setSeason($season1);
        $standing1->setLeague($league);

        $standing2 = TestHelper::createLeagueStanding($team1, 2);
        $standing2->setSeason($season2);
        $standing2->setLeague($league);

        $standings = $team1->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(2, $standings->count());
    }

    public function testAddStandingsBidirectional()
    {
        $team1 = TestHelper::createTeam("team1");
        $season1 = TestHelper::createSeason(1);
        $season2 = TestHelper::createSeason(2);
        $league = TestHelper::createLeague("EPL");

        $standing1 = TestHelper::createLeagueStanding($team1, 1);
        $standing1->setSeason($season1);
        $standing1->setLeague($league);

        $standing2 = TestHelper::createLeagueStanding($team1, 2);
        $standing2->setSeason($season2);
        $standing2->setLeague($league);

        $standings = $team1->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(2, $standings->count());

        $team1 = $team1->getStandings()->get(0)->getTeam();
        $this->assertNotNull($team1);
        $this->assertEquals("team1", $team1->getName());
    }

    public function testRemoveStandings()
    {
        $team1 = TestHelper::createTeam("team1");
        $season1 = TestHelper::createSeason(1);
        $season2 = TestHelper::createSeason(2);
        $league = TestHelper::createLeague("EPL");

        $standing1 = TestHelper::createLeagueStanding($team1, 1);
        $standing1->setSeason($season1);
        $standing1->setLeague($league);

        $standing2 = TestHelper::createLeagueStanding($team1, 2);
        $standing2->setSeason($season2);
        $standing2->setLeague($league);

        $standings = $team1->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(2, $standings->count());

        $team1->removeStanding($standing1);
        $standings = $team1->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(1, $standings->count());
    }

    public function testRemoveStandingsBidirectional()
    {
        $team1 = TestHelper::createTeam("team1");
        $season1 = TestHelper::createSeason(1);
        $season2 = TestHelper::createSeason(2);
        $league = TestHelper::createLeague("EPL");

        $standing1 = TestHelper::createLeagueStanding($team1, 1);
        $standing1->setSeason($season1);
        $standing1->setLeague($league);

        $standing2 = TestHelper::createLeagueStanding($team1, 2);
        $standing2->setSeason($season2);
        $standing2->setLeague($league);

        $standings = $team1->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(2, $standings->count());

        $team1->removeStanding($standing1);
        $standings = $team1->getStandings();
        $this->assertNotNull($standings);
        $this->assertEquals(1, $standings->count());

        $team1 = $standing1->getTeam();
        $this->assertNull($team1);
    }

    public function testUserBidirectional()
    {
        $user = TestHelper::createUser("user1");
        $team = TestHelper::createTeam("Liverpool");
        $user->setTeam($team);

        $this->assertNotNUll($team->getUser());
        $this->assertEquals("user1", $team->getUser()->getUsername());
    }

    public function testStadium()
    {
        $stadium = TestHelper::createStadium("stadium1");
        $team = TestHelper::createTeam("team1");
        $team->setStadium($stadium);

        $stadium = $team->getStadium();
        $this->assertNotNull($stadium);
        $this->assertEquals("stadium1", $stadium->getName());
    }

    public function testStadiumBidirectional()
    {
        $stadium = TestHelper::createStadium("stadium1");
        $team = TestHelper::createTeam("team1");
        $team->setStadium($stadium);

        $stadium = $team->getStadium();
        $this->assertNotNull($stadium);
        $this->assertEquals("stadium1", $stadium->getName());

        $team = $stadium->getTeams()->get(0);
        $this->assertNotNull($team);
        $this->assertEquals("team1", $team->getName());

    }

    public function checkMatches($matches)
    {
        $this->assertNotNull($matches);
        $this->assertFalse($matches->isEmpty());
        $this->assertEquals(1, $matches->count());
        $this->assertEquals("Liverpool", $matches->toArray()[0]->getHomeTeam()->getName());
        $this->assertEquals("Arsenal", $matches->toArray()[0]->getAwayTeam()->getName());
    }
}