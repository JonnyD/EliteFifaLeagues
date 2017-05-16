<?php

namespace EliteFifa\Bundle\Tests\Manager;

use EliteFifa\Bundle\Tests\BaseWebTestCase;

class MatchManagerTest extends BaseWebTestCase
{
    private $teamManager;
    private $matchManager;
    private $userManager;

    public function setUp()
    {
        parent::setUp();

        $this->teamManager = $this->getContainer()->get("elite_fifa.team_manager");
        $this->matchManager = $this->getContainer()->get("elite_fifa.match_manager");
        $this->userManager = $this->getContainer()->get("elite_fifa.user_manager");
    }

    public function testGetAllMatches()
    {
        $matches = $this->matchManager->getAllMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(24, count($matches));
    }

    public function testGetMatchesByUser()
    {
        $user = $this->userManager->getUserByUsername("user1");
        $matches = $this->matchManager->getMatchesByUser($user);
        $this->assertNotNull($matches);
        $this->assertEquals(12, count($matches));
    }

    public function testGetMatchesByTeam()
    {
        $team = $this->teamManager->getTeamByName("Liverpool");
        $this->assertNotNull($team);
        $this->assertEquals("Liverpool", $team->getName());

        $matches = $this->matchManager->getAllMatchesByTeam($team);
        $this->assertNotNull($matches);
        $this->assertEquals(12, count($matches));
    }

    public function testGetHomeMatchesByTeam()
    {
        $team = $this->teamManager->getTeamByName("Liverpool");
        $matches = $this->matchManager->getHomeMatchesByTeam($team);
        $this->assertNotNull($matches);
        $this->assertEquals(6, count($matches));
    }

    public function testGetAwayMatchesByTeam()
    {
        $team = $this->teamManager->getTeamByName("Liverpool");
        $matches = $this->matchManager->getAwayMatchesByTeam($team);
        $this->assertNotNull($matches);
        $this->assertEquals(6, count($matches));
    }

    public function testGetUnreportedMatches()
    {
        $matches = $this->matchManager->getUnreportedMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(1, count($matches));
    }

    public function testGetMatchById()
    {
        $match = $this->matchManager->getMatchById(1);

        $this->assertNotNull($match);
        $homeTeam = $match->getHomeTeam();
        $this->assertNotNull($homeTeam);
        $this->assertEquals("Liverpool", $homeTeam->getName());

        $awayTeam = $match->getAwayTeam();
        $this->assertNotNull($awayTeam);
        $this->assertEquals("Chelsea", $awayTeam->getName());
    }

    public function testGetMatchesForCompetitionBySeason()
    {
        //TODO
    }

    public function testGetMatchesForCompetitionBySeasonAndRound()
    {
        //TODO
    }
}