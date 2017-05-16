<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\Goal;
use EliteFifa\Bundle\Entity\Match;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\Player;
use EliteFifa\Bundle\Tests\TestHelper;

class GoalTest extends \PHPUnit_Framework_TestCase
{
    public function testMatch()
    {
        $match = $this->createMatch();

        $goal = new Goal();
        $goal->setMatch($match);

        $this->assertNotNull($goal->getMatch());
        $this->assertEquals("Liverpool", $goal->getMatch()->getHomeTeam()->getName());
        $this->assertEquals("Chelsea", $goal->getMatch()->getAwayTeam()->getName());
    }

    public function testMatchBidirectional()
    {
        $match = $this->createMatch();

        $goal1 = new Goal();
        $goal1->setMatch($match);

        $goal2 = new Goal();
        $goal2->setMatch($match);

        $goals = $match->getGoals();
        $this->assertNotNull($goals);
        $this->assertFalse($goals->isEmpty());
        $this->assertEquals(2, $goals->count());
    }

    public function testPlayer()
    {
        $player = TestHelper::createPlayer("Suarez");

        $goal = new Goal();
        $goal->setPlayer($player);

        $this->assertNotNull($goal->getPlayer());
        $this->assertEquals("Suarez", $goal->getPlayer()->getName());
    }

    public function testPlayerBidirectional()
    {
        $player = TestHelper::createPlayer("Suarez");

        $goal = new Goal();
        $goal->setPlayer($player);

        $player = $goal->getPlayer();
        $this->assertNotNull($player);
        $this->assertEquals("Suarez", $player->getName());
    }

    private function createMatch()
    {
        $homeTeam = TestHelper::createTeam("Liverpool");
        $awayTeam = TestHelper::createTeam("Chelsea");
        $match = TestHelper::createMatch($homeTeam, $awayTeam);
        return $match;
    }
}