<?php

namespace EliteFifa\Bundle\Tests\Entity;

use EliteFifa\Bundle\Entity\Competition;
use EliteFifa\Bundle\Tests\TestHelper;

class CompetitionTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $competition = TestHelper::createCompetition("World");

        $this->assertNotNull($competition);
        $this->assertEquals("World", $competition->getName());
    }

    public function testAssociation()
    {
        $competition = TestHelper::createCompetition("League 1");
        $association = TestHelper::createAssociation("World");
        $competition->setAssociation($association);

        $association = $competition->getAssociation();
        $this->assertNotNull($association);
        $this->assertEquals("World", $association->getName());
    }

    public function testAssociationBidirectional()
    {
        $competition = TestHelper::createCompetition("League 1");
        $association = TestHelper::createAssociation("World");
        $competition->setAssociation($association);

        $association = $competition->getAssociation();
        $this->assertNotNull($association);
        $this->assertEquals("World", $association->getName());

        $competition = $association->getCompetitions()->get(0);
        $this->assertNotNull($competition);
        $this->assertEquals("League 1", $competition->getName());
    }

    public function testRemoveAssociation()
    {
        $competition = TestHelper::createCompetition("League 1");
        $association = TestHelper::createAssociation("World");
        $competition->setAssociation($association);

        $association = $competition->getAssociation();
        $this->assertNotNull($association);
        $this->assertEquals("World", $association->getName());

        $competition->removeAssociation();

        $association = $competition->getAssociation();
        $this->assertNull($association);
    }

    public function testRemoveAssociationBidirectional()
    {
        //TODO
    }

    public function testAddSeason()
    {
        $competition = TestHelper::createCompetition("League 1");

        $season1 = TestHelper::createSeason(1);
        $season2 = TestHelper::createSeason(2);
        $season3 = TestHelper::createSeason(3);

        $competition->addSeason($season1);
        $competition->addSeason($season2);
        $competition->addSeason($season3);

        $this->assertTrue($competition->hasSeason($season1));
        $this->assertTrue($competition->hasSeason($season2));
        $this->assertTrue($competition->hasSeason($season3));

        $seasons = $competition->getSeasons();
        $this->assertNotNull($seasons);
        $this->assertEquals(3, count($seasons));
    }

    public function testAddSeasonBidirectional()
    {
        $competition = TestHelper::createCompetition("League 1");

        $season1 = TestHelper::createSeason(1);
        $season2 = TestHelper::createSeason(2);
        $season3 = TestHelper::createSeason(3);

        $competition->addSeason($season1);
        $competition->addSeason($season2);
        $competition->addSeason($season3);

        $this->assertTrue($competition->hasSeason($season1));
        $this->assertTrue($competition->hasSeason($season2));
        $this->assertTrue($competition->hasSeason($season3));

        $seasons = $competition->getSeasons();
        $this->assertNotNull($seasons);
        $this->assertEquals(3, count($seasons));

        $competition = $seasons->get(1)->getCompetitions()->get(0);
        $this->assertNotNull($competition);
        $this->assertEquals("League 1", $competition->getName());
    }

    public function testRemoveSeason()
    {
        $competition = TestHelper::createCompetition("League 1");

        $season1 = TestHelper::createSeason(1);
        $season2 = TestHelper::createSeason(2);
        $season3 = TestHelper::createSeason(3);

        $competition->addSeason($season1);
        $competition->addSeason($season2);
        $competition->addSeason($season3);

        $this->assertTrue($competition->hasSeason($season1));
        $this->assertTrue($competition->hasSeason($season2));
        $this->assertTrue($competition->hasSeason($season3));

        $seasons = $competition->getSeasons();
        $this->assertNotNull($seasons);
        $this->assertEquals(3, count($seasons));

        $competition->removeSeason($season2);
        $this->assertFalse($competition->hasSeason($season2));

        $seasons = $competition->getSeasons();
        $this->assertNotNull($seasons);
        $this->assertEquals(2, count($seasons));
    }

    public function testRemoveSeasonBidirectional()
    {
        $competition = TestHelper::createCompetition("League 1");

        $season1 = TestHelper::createSeason(1);
        $season2 = TestHelper::createSeason(2);
        $season3 = TestHelper::createSeason(3);

        $competition->addSeason($season1);
        $competition->addSeason($season2);
        $competition->addSeason($season3);

        $this->assertTrue($competition->hasSeason($season1));
        $this->assertTrue($competition->hasSeason($season2));
        $this->assertTrue($competition->hasSeason($season3));

        $seasons = $competition->getSeasons();
        $this->assertNotNull($seasons);
        $this->assertEquals(3, count($seasons));

        $competition->removeSeason($season2);
        $this->assertFalse($competition->hasSeason($season2));

        $seasons = $competition->getSeasons();
        $this->assertNotNull($seasons);
        $this->assertEquals(2, count($seasons));

        $competition = $season2->getCompetitions()->get(0);
        $this->assertNull($competition);
    }
}