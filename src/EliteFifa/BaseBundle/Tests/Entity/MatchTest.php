<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\Match;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Tests\TestHelper;

class MatchTest extends \PHPUnit_Framework_TestCase
{
    public function testHomeTeam()
    {
        $homeTeam = TestHelper::createTeam("Liverpool");

        $match = new Match();
        $match->setHomeTeam($homeTeam);

        $this->assertNotNull($match);
        $this->assertNotNull($match->getHomeTeam());
        $this->assertEquals("Liverpool", $match->getHomeTeam()->getName());
    }

    public function testAwayTeam()
    {
        $awayTeam = TestHelper::createTeam("Arsenal");

        $match = new Match();
        $match->setAwayTeam($awayTeam);

        $this->assertNotNull($match);
        $this->assertNotNull($match->getAwayTeam());
        $this->assertEquals("Arsenal", $match->getAwayTeam()->getName());
    }

    public function testHomeAndAwayTeam()
    {
        $homeTeam = TestHelper::createTeam("Liverpool");
        $awayTeam = TestHelper::createTeam("Arsenal");
        $match = TestHelper::createMatch($homeTeam, $awayTeam);

        $this->assertNotNull($match);
        $this->assertEquals("Liverpool", $match->getHomeTeam()->getName());
        $this->assertEquals("Arsenal", $match->getAwayTeam()->getName());
    }

    public function testHomeUser()
    {
        $homeUser = TestHelper::createUser("user1");

        $match = new Match();
        $match->setHomeUser($homeUser);

        $this->assertNotNull($match);
        $this->assertEquals("user1", $match->getHomeUser()->getUsername());
    }

    public function testHomeUserBidirectional()
    {
        $homeUser = TestHelper::createUser("user1");

        $match = new Match();
        $match->setHomeUser($homeUser);

        $this->assertNotNull($match);
        $this->assertEquals("user1", $match->getHomeUser()->getUsername());

        $matchBi = $homeUser->getHomeMatches()[0];
        $this->assertNotNull($matchBi);
        $this->assertEquals("user1", $matchBi->getHomeUser()->getUsername());
    }

    public function testAwayUser()
    {
        $awayUser = TestHelper::createUser("user2");

        $match = new Match();
        $match->setAwayUser($awayUser);

        $this->assertNotNull($match);
        $this->assertEquals("user2", $match->getAwayUser()->getUsername());
    }

    public function testAwayUserBidirectional()
    {
        $awayUser = TestHelper::createUser("user2");

        $match = new Match();
        $match->setAwayUser($awayUser);

        $this->assertNotNull($match);
        $this->assertEquals("user2", $match->getAwayUser()->getUsername());

        $matchBi = $awayUser->getAwayMatches()[0];
        $this->assertNotNull($matchBi);
        $this->assertEquals("user2", $matchBi->getAwayUser()->getUsername());
    }

    public function testLeague()
    {
        $league = TestHelper::createLeague("league1");

        $match = new Match();
        $match->setLeague($league);

        $this->assertNotNull($match);
        $this->assertEquals("league1", $match->getLeague()->getName());
    }

    public function testLeagueBidirectional()
    {
        $league = TestHelper::createLeague("league2");

        $match = new Match();
        $match->setLeague($league);

        $this->assertNotNull($match);
        $this->assertEquals("league2", $match->getLeague()->getName());

        $match = $match->getLeague()->getMatches()->get(0);
        $this->assertNotNull($match);
        $this->assertEquals($league->getName(), $match->getLeague()->getName());
    }

    public function testSeason()
    {
        $season = TestHelper::createSeason(1);

        $match = new Match();
        $match->setSeason($season);

        $this->assertNotNull($match);
        $this->assertEquals(1, $match->getSeason()->getNumber());
    }

    public function testSeasonBidirectional()
    {
        $season = TestHelper::createSeason(1);

        $match = new Match();
        $match->setSeason($season);

        $this->assertNotNull($match);
        $this->assertEquals(1, $match->getSeason()->getNumber());

        $matchBi = $match->getSeason()->getMatches()->get(0);
        $this->assertNotNull($matchBi);
        $this->assertEquals($match, $matchBi);
    }

    public function testHomeScore()
    {
        $match = TestHelper::createTestMatch();
        $match->setHomeScore(2);

        $this->assertNotNull($match);
        $this->assertEquals(2, $match->getHomeScore());
    }

    public function testAwayScore()
    {
        $match = TestHelper::createTestMatch();
        $match->setAwayScore(2);

        $this->assertNotNull($match);
        $this->assertEquals(2, $match->getAwayScore());
    }

    public function testScore()
    {
        $match = TestHelper::createTestMatch();
        $match->setHomeScore(2);
        $match->setAwayScore(3);

        $this->assertNotNull($match);
        $this->assertEquals(2, $match->getHomeScore());
        $this->assertEquals(3, $match->getAwayScore());
    }

    public function testGoals()
    {
        $match = TestHelper::createTestMatch();
        $goals = $match->getGoals();

        $this->assertNotNull($goals);
        $this->assertTrue($goals->isEmpty());
        $this->assertEquals(0, $goals->count());
    }

    public function testHasGoal()
    {
        $match = TestHelper::createTestMatch();

        $goal = $this->createGoal("Suarez");

        $hasGoal1 = $match->hasGoal($goal);
        $this->assertFalse($hasGoal1);

        $match->addGoal($goal);
        $hasGoal2 = $match->hasGoal($goal);
        $this->assertTrue($hasGoal2);
    }

    public function testAddGoal()
    {
        $match = TestHelper::createTestMatch();

        $goal1 = $this->createGoal("Suarez");
        $goal2 = $this->createGoal("Sturridge");

        $match->addGoal($goal1);
        $match->addGoal($goal2);

        $goals = $match->getGoals();
        $this->assertNotNull($goals);
        $this->assertFalse($goals->isEmpty());
        $this->assertEquals(2, $goals->count());
    }

    public function testRemoveGoal()
    {
        $match = TestHelper::createTestMatch();

        $goal1 = $this->createGoal("Suarez");
        $goal2 = $this->createGoal("Sturridge");

        $match->addGoal($goal1);
        $match->addGoal($goal2);

        $goals = $match->getGoals();
        $this->assertNotNull($goals);
        $this->assertFalse($goals->isEmpty());
        $this->assertEquals(2, $goals->count());

        $match->removeGoal($goal1);
        $goals2 = $match->getGoals();
        $this->assertNotNull($goals2);
        $this->assertFalse($goals2->isEmpty());
        $this->assertEquals(1, $goals->count());
    }

    public function testResult()
    {
        $match = TestHelper::createTestMatch();
        $match->setHomeScore(2);
        $match->setAwayScore(1);

        $goal1 = $this->createGoal("Suarez");
        $goal2 = $this->createGoal("Gerrard");
        $goal3 = $this->createGoal("Hazard");

        $match->addGoal($goal1);
        $match->addGoal($goal2);
        $match->addGoal($goal3);

        $goals = $match->getGoals();
        $this->assertNotNull($goals);
        $this->assertEquals(3, $goals->count());
    }

    public function testTournament()
    {
        $match = TestHelper::createMatch("Liverpool", "Arsenal");
        $tournament = TestHelper::createTournament("Cup 1");
        $match->setTournament($tournament);

        $tournament = $match->getTournament();
        $this->assertNotNull($tournament);
        $this->assertEquals("Cup 1", $tournament->getName());
    }

    public function testTournamentBidirectional()
    {
        $match = TestHelper::createMatch("Liverpool", "Arsenal");
        $tournament = TestHelper::createTournament("Cup 1");
        $match->setTournament($tournament);

        $tournament = $match->getTournament();
        $this->assertNotNull($tournament);
        $this->assertEquals("Cup 1", $tournament->getName());

        $matchBi = $tournament->getMatches()->get(0);
        $this->assertNotNull($matchBi);
        $this->assertEquals($match, $matchBi);
    }

    public function testRemoveTournament()
    {
        $match = TestHelper::createMatch("Liverpool", "Arsenal");
        $tournament = TestHelper::createTournament("Cup 1");
        $match->setTournament($tournament);

        $tournament = $match->getTournament();
        $this->assertNotNull($tournament);
        $this->assertEquals("Cup 1", $tournament->getName());

        $match->removeTournament();
        $tournament = $match->getTournament();
        $this->assertNull($tournament);
    }

    public function testRemoveTournamentBidirectional()
    {
        $match = TestHelper::createMatch("Liverpool", "Arsenal");
        $tournament = TestHelper::createTournament("Cup 1");
        $match->setTournament($tournament);

        $tournament = $match->getTournament();
        $this->assertNotNull($tournament);
        $this->assertEquals("Cup 1", $tournament->getName());

        $match->removeTournament();
        $match = $tournament->getMatches()->get(0);
        $this->assertNull($match);
    }

    public function testRound()
    {
        $match = TestHelper::createMatch("Liverpool", "Arsenal");
        $match->setRound(10);

        $this->assertNotNull($match);
        $this->assertEquals(10, $match->getRound());
    }

    private function createGoal($name)
    {
        $player = TestHelper::createPlayer($name);
        $goal = TestHelper::createGoal($player);
        return $goal;
    }
}