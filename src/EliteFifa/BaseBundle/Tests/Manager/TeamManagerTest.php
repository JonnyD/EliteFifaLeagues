<?php

namespace EliteFifa\Bundle\Tests\Manager;

use EliteFifa\Bundle\Tests\BaseWebTestCase;

class TeamManagerTest extends BaseWebTestCase
{
    private $teamManager;

    public function setUp()
    {
        parent::setUp();

        $this->teamManager = $this->getContainer()->get("elite_fifa.team_manager");
    }

    public function testGetAllTeams()
    {
        $teams = $this->teamManager->getAllTeams();

        $this->assertNotNull($teams);
        $this->assertEquals(4, count($teams));
    }

    public function testGetTeamById()
    {
        $team = $this->teamManager->getTeamById(4);

        $this->assertNotNull($team);
        $this->assertEquals("Liverpool", $team->getName());
    }

    public function testGetTeamByName()
    {
        $teamName = "Liverpool";
        $team = $this->teamManager->getTeamByName($teamName);

        $this->assertNotNull($team);
        $this->assertEquals("Liverpool", $team->getName());
    }

    public function testGetTeamBySlug()
    {
        $team = $this->teamManager->getTeamBySlug("rotherham-united");
        $this->assertNotNull($team);
        $this->assertEquals("Rotherham United", $team->getName());
    }

    public function testGetTeamsWithoutAManager()
    {
        $teams = $this->teamManager->getTeamsWithoutAManager();

        $this->assertNotNull($teams);
        $this->assertEquals(0, count($teams));
    }
}