<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\Stadium;
use EliteFifa\Bundle\Tests\TestHelper;

class StadiumTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $stadium = new Stadium();
        $stadium->setName("stadium1");

        $this->assertNotNull($stadium);
        $this->assertEquals("stadium1", $stadium->getName());
    }

    public function testAddTeam()
    {
        $stadium = TestHelper::createStadium("stadium1");

        $team1 = TestHelper::createTeam("team1");
        $team2 = TestHelper::createTeam("team2");
        $team3 = TestHelper::createTeam("team3");

        $stadium->addTeam($team1);
        $stadium->addTeam($team2);
        $stadium->addTeam($team3);

        $this->assertTrue($stadium->hasTeam($team1));
        $this->assertTrue($stadium->hasTeam($team2));
        $this->assertTrue($stadium->hasTeam($team3));

        $teams = $stadium->getTeams();
        $this->assertNotNull($teams);
        $this->assertEquals(3, count($teams));
    }

    public function testAddTeamBidirectional()
    {
        $stadium = TestHelper::createStadium("stadium1");

        $team1 = TestHelper::createTeam("team1");
        $team2 = TestHelper::createTeam("team2");
        $team3 = TestHelper::createTeam("team3");

        $stadium->addTeam($team1);
        $stadium->addTeam($team2);
        $stadium->addTeam($team3);

        $this->assertTrue($stadium->hasTeam($team1));
        $this->assertTrue($stadium->hasTeam($team2));
        $this->assertTrue($stadium->hasTeam($team3));

        $teams = $stadium->getTeams();
        $this->assertNotNull($teams);
        $this->assertEquals(3, count($teams));

        $stadium = $team2->getStadium();
        $this->assertNotNull($stadium);
        $this->assertEquals("stadium1", $stadium->getName());
    }

    public function testRemoveTeam()
    {
        $stadium = TestHelper::createStadium("stadium1");

        $team1 = TestHelper::createTeam("team1");
        $team2 = TestHelper::createTeam("team2");
        $team3 = TestHelper::createTeam("team3");

        $stadium->addTeam($team1);
        $stadium->addTeam($team2);
        $stadium->addTeam($team3);

        $this->assertTrue($stadium->hasTeam($team1));
        $this->assertTrue($stadium->hasTeam($team2));
        $this->assertTrue($stadium->hasTeam($team3));

        $teams = $stadium->getTeams();
        $this->assertNotNull($teams);
        $this->assertEquals(3, count($teams));

        $stadium->removeTeam($team2);
        $this->assertFalse($stadium->hasTeam($team2));

        $teams = $stadium->getTeams();
        $this->assertNotNull($teams);
        $this->assertEquals(2, count($teams));
    }

    public function testRemoveTeamBidirectional()
    {
        $stadium = TestHelper::createStadium("stadium1");

        $team1 = TestHelper::createTeam("team1");
        $team2 = TestHelper::createTeam("team2");
        $team3 = TestHelper::createTeam("team3");

        $stadium->addTeam($team1);
        $stadium->addTeam($team2);
        $stadium->addTeam($team3);

        $this->assertTrue($stadium->hasTeam($team1));
        $this->assertTrue($stadium->hasTeam($team2));
        $this->assertTrue($stadium->hasTeam($team3));

        $teams = $stadium->getTeams();
        $this->assertNotNull($teams);
        $this->assertEquals(3, count($teams));

        $stadium->removeTeam($team2);
        $this->assertFalse($stadium->hasTeam($team2));

        $teams = $stadium->getTeams();
        $this->assertNotNull($teams);
        $this->assertEquals(2, count($teams));

        $stadium = $team2->getStadium();
        $this->assertNull($stadium);
    }
}