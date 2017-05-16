<?php

namespace EliteFifa\Bundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Input\ArrayInput;
use Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand;
use Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand;
use EliteFifa\Bundle\Tests\BaseWebTestCase;
use EliteFifa\Bundle\Entity\Team;

class TeamRepositoryTest extends BaseWebTestCase
{
    private $teamRepository;

    public function setUp()
    {
        parent::setUp();

        $this->teamRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Team');
    }

    public function testFindAll()
    {
        $teams = $this->teamRepository->findAll();
        $this->assertNotNull($teams);
        $this->assertTrue(is_array($teams));
        $this->assertEquals(4, count($teams));
    }

    public function testFindOneById()
    {
        $team = $this->teamRepository->find(1);
        $this->assertNotNull($team);
        $this->assertEquals(1, $team->getId());
    }

    public function testFindOneByName()
    {
        $team = $this->teamRepository->findOneByName("Liverpool");
        $this->assertNotNull($team);
        $this->assertEquals("Liverpool", $team->getName());
    }

    public function testFindOneBySlug()
    {
        $team = $this->teamRepository->findOneBySlug("rotherham-united");
        $this->assertNotNull($team);
        $this->assertEquals("Rotherham United", $team->getName());
    }

    public function testFindPlayersByTeam()
    {
        $team = $this->teamRepository->findOneByName("Liverpool");
        $this->assertNotNull($team);
        $players = $team->getPlayers();
        $this->assertNotNull($players);
        $this->assertFalse($players->isEmpty());
    }

    public function testFindTeamsWithoutAManager()
    {
        $teams = $this->teamRepository->findTeamsWithoutAManager();

        $this->assertNotNull($teams);
        $this->assertEquals(0, count($teams));
    }
}