<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\Player;
use EliteFifa\Bundle\Entity\Team;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $player = new Player();
        $player->setName("Suarez");

        $this->assertNotNull($player);
        $this->assertEquals("Suarez", $player->getName());
    }

    public function testAddTeam()
    {
        $team = new Team();
        $team->setName("Liverpool");

        $player = new Player();
        $player->setName("Suarez");
        $player->setTeam($team);

        $this->assertNotNull($player);
        $this->assertNotNull($player->getTeam());
        $this->assertEquals("Liverpool", $player->getTeam()->getName());
    }

    public function testRemoveTeam()
    {
        $team = new Team();
        $team->setName("Liverpool");

        $player = new Player();
        $player->setName("Suarez");
        $player->setTeam($team);

        $this->assertNotNull($player);
        $this->assertNotNull($player->getTeam());
        $this->assertEquals("Liverpool", $player->getTeam()->getName());

        $player->removeTeam();
        $this->assertNull($player->getTeam());
    }

    public function testUpdateTeam()
    {
        $team = new Team();
        $team->setName("Liverpool");

        $player = new Player();
        $player->setName("Suarez");
        $player->setTeam($team);

        $this->assertNotNull($player);
        $this->assertNotNull($player->getTeam());
        $this->assertEquals("Liverpool", $player->getTeam()->getName());

        $team2 = new Team();
        $team2->setName("Arsenal");

        $player->setTeam($team2);

        $this->assertNotNull($player->getTeam());
        $this->assertEquals("Arsenal", $player->getTeam()->getName());
    }

    public function testTeamAddBidirectional()
    {
        $team = new Team();
        $team->setName("Liverpool");

        $suarez = new Player();
        $suarez->setName("Suarez");
        $suarez->setTeam($team);

        $gerrard = new Player();
        $gerrard->setName("Gerrard");
        $gerrard->setTeam($team);

        $teamSet = $suarez->getTeam();
        $this->assertNotNull($teamSet);

        $players = $teamSet->getPlayers();
        $this->assertNotNull($players);
        $this->assertFalse($players->isEmpty());
        $this->assertEquals(2, $players->count());
    }

    public function testTeamRemoveBidirectional()
    {
        $team = new Team();
        $team->setName("Liverpool");

        $suarez = new Player();
        $suarez->setName("Suarez");
        $suarez->setTeam($team);

        $gerrard = new Player();
        $gerrard->setName("Gerrard");
        $gerrard->setTeam($team);

        $teamSet = $suarez->getTeam();
        $this->assertNotNull($teamSet);

        $players = $teamSet->getPlayers();
        $this->assertNotNull($players);
        $this->assertFalse($players->isEmpty());
        $this->assertEquals(2, $players->count());

        $suarez->removeTeam();
        $teamRemoved = $suarez->getTeam();
        $this->assertNull($teamRemoved);

        $players2 = $teamSet->getPlayers();
        $this->assertNotNull($players2);
        $this->assertFalse($players2->isEmpty());
        $this->assertEquals(1, $players2->count());
    }

    public function testTeamUpdateBidirectional()
    {
        $liverpool = new Team();
        $liverpool->setName("Liverpool");

        $suarez = new Player();
        $suarez->setName("Suarez");
        $suarez->setTeam($liverpool);

        $gerrard = new Player();
        $gerrard->setName("Gerrard");
        $gerrard->setTeam($liverpool);

        $liverpool2 = $suarez->getTeam();
        $this->assertNotNull($liverpool2);
        $this->assertEquals("Liverpool", $liverpool2->getName());

        $liverpoolPlayers = $liverpool2->getPlayers();
        $this->assertNotNull($liverpoolPlayers);
        $this->assertFalse($liverpoolPlayers->isEmpty());
        $this->assertEquals(2, $liverpoolPlayers->count());

        $arsenal = new Team();
        $arsenal->setName("Arsenal");

        $suarez->setTeam($arsenal);
        $arsenal2 = $suarez->getTeam();

        $this->assertNotNull($arsenal2);
        $this->assertEquals("Arsenal", $arsenal2->getName());

        $arsenalPlayers = $arsenal2->getPlayers();
        $this->assertNotNull($arsenalPlayers);
        $this->assertFalse($arsenalPlayers->isEmpty());
        $this->assertEquals(1, $arsenalPlayers->count());
        $this->assertEquals("Suarez", $arsenalPlayers->toArray()[0]->getName());

        $liverpoolPlayers2 = $liverpool2->getPlayers();
        $this->assertNotNull($liverpoolPlayers2);
        $this->assertFalse($liverpoolPlayers2->isEmpty());
        $this->assertEquals(1, $liverpoolPlayers2->count());
        $this->assertEquals("Gerrard", $liverpoolPlayers2->toArray()[1]->getName());
    }
}