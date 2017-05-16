<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\Competition;
use EliteFifa\Bundle\Tests\TestHelper;

class TournamentTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $tournament = TestHelper::createTournament("Cup 1");

        $this->assertNotNull($tournament);
        $this->assertEquals("Cup 1", $tournament->getName());
    }

    public function testAddMatches()
    {
        $tournament = TestHelper::createTournament("Cup 1");

        $match1 = TestHelper::createMatch("Liverpool", "Chelsea");
        $match2 = TestHelper::createMatch("Arsenal", "Man City");
        $match3 = TestHelper::createMatch("Everton", "Man United");

        $tournament->addMatch($match1);
        $tournament->addMatch($match2);
        $tournament->addMatch($match3);

        $this->assertTrue($tournament->hasMatch($match1));
        $this->assertTrue($tournament->hasMatch($match2));
        $this->assertTrue($tournament->hasMatch($match3));

        $matches = $tournament->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, count($matches));
    }

    public function testAddMatchesBidirectional()
    {
        $tournament = TestHelper::createTournament("Cup 1");

        $match1 = TestHelper::createMatch("Liverpool", "Chelsea");
        $match2 = TestHelper::createMatch("Arsenal", "Man City");
        $match3 = TestHelper::createMatch("Everton", "Man United");

        $tournament->addMatch($match1);
        $tournament->addMatch($match2);
        $tournament->addMatch($match3);

        $this->assertTrue($tournament->hasMatch($match1));
        $this->assertTrue($tournament->hasMatch($match2));
        $this->assertTrue($tournament->hasMatch($match3));

        $matches = $tournament->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, count($matches));

        $tournament = $matches->get(0)->getTournament();
        $this->assertNotNull($tournament);
        $this->assertEquals("Cup 1", $tournament->getName());
    }

    public function testRemoveMatches()
    {
        $tournament = TestHelper::createTournament("Cup 1");

        $match1 = TestHelper::createMatch("Liverpool", "Chelsea");
        $match2 = TestHelper::createMatch("Arsenal", "Man City");
        $match3 = TestHelper::createMatch("Everton", "Man United");

        $tournament->addMatch($match1);
        $tournament->addMatch($match2);
        $tournament->addMatch($match3);

        $this->assertTrue($tournament->hasMatch($match1));
        $this->assertTrue($tournament->hasMatch($match2));
        $this->assertTrue($tournament->hasMatch($match3));

        $matches = $tournament->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, count($matches));

        $tournament->removeMatch($match2);
        $this->assertFalse($tournament->hasMatch($match2));

        $matches = $tournament->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(2, count($matches));
    }

    public function testRemoveMatchesBidirectional()
    {
        $tournament = TestHelper::createTournament("Cup 1");

        $match1 = TestHelper::createMatch("Liverpool", "Chelsea");
        $match2 = TestHelper::createMatch("Arsenal", "Man City");
        $match3 = TestHelper::createMatch("Everton", "Man United");

        $tournament->addMatch($match1);
        $tournament->addMatch($match2);
        $tournament->addMatch($match3);

        $this->assertTrue($tournament->hasMatch($match1));
        $this->assertTrue($tournament->hasMatch($match2));
        $this->assertTrue($tournament->hasMatch($match3));

        $matches = $tournament->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(3, count($matches));

        $tournament->removeMatch($match2);
        $this->assertFalse($tournament->hasMatch($match2));

        $matches = $tournament->getMatches();
        $this->assertNotNull($matches);
        $this->assertEquals(2, count($matches));

        $tournament = $match2->getTournament();
        $this->assertNull($tournament);
    }
}