<?php

namespace EliteFifa\Bundle\Tests\Manager;

use EliteFifa\Bundle\Entity\League;
use EliteFifa\Bundle\Entity\LeagueStanding;
use EliteFifa\Bundle\Entity\Match;
use EliteFifa\Bundle\Entity\Season;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\User;
use EliteFifa\Bundle\Tests\BaseWebTestCase;

class SeasonManagerTest extends BaseWebTestCase
{
    private $seasonManager;
    private $leagueManager;

    public function setUp()
    {
        parent::setUp();

        $this->seasonManager = $this->getContainer()->get("elite_fifa.season_manager");
        $this->leagueManager = $this->getContainer()->get("elite_fifa.league_manager");
    }

    public function testCreateSeasonForLadder()
    {
        $league = $this->leagueManager->getLeagueByName("EFL Ladder");
        $season = $this->seasonManager->createSeasonForLadder($league);

        $this->assertNotNull($season);
        $this->assertEquals(1, $season->getNumber());
        $this->assertEquals(new \DateTime('first day of this month 00:00:00'), $season->getStartDate());
        $this->assertEquals(new \DateTime('last day of this month 23:59:59'), $season->getEndDate());
        $this->assertEquals($league, $season->getLeague());
    }

    public function testGetCurrentSeasonForLeague()
    {
        $league = $this->leagueManager->getLeagueByName("Premier League");
        $season = $this->seasonManager->getCurrentSeasonForLeague($league);

        $this->assertNotNull($season);
        $this->assertEquals(2, $season->getNumber());
        $this->assertEquals("2014-02-25 00:00:00", $season->getStartDate()->format('Y-m-d H:i:s'));
        $this->assertEquals("2014-04-20 00:00:00", $season->getEndDate()->format('Y-m-d H:i:s'));
    }

    public function testGetSeasonForCompetitionByNumber()
    {
        //TODO
    }

    public function testGetSeasonsByCompetition()
    {
        //TODO
    }
}