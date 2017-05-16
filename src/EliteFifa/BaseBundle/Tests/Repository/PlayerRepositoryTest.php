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
use EliteFifa\Bundle\Entity\Player;

class PlayerRepositoryTest extends BaseWebTestCase
{
    private $playerRepository;

    public function setUp()
    {
        parent::setUp();

        $this->playerRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Player');
    }

    public function testFindAll()
    {
        $players = $this->playerRepository->findAll();
        $this->assertNotNull($players);
        $this->assertTrue(is_array($players));
        $this->assertEquals(8, count($players));
    }

    public function testFindOneById()
    {
        $player = $this->playerRepository->find(1);
        $this->assertNotNull($player);
        $this->assertEquals(1, $player->getId());
    }

    public function testFindOneByName()
    {
        $player = $this->playerRepository->findOneByName("Suarez");
        $this->assertNotNull($player);
        $this->assertEquals("Suarez", $player->getName());
    }

    public function testFindTeamByPlayer()
    {
        $player = $this->playerRepository->findOneByName("Suarez");
        $this->assertNotNull($player);
        $team = $player->getTeam();
        $this->assertNotNull($team);
        $this->assertEquals("Liverpool", $team->getName());
    }

    public function testFindPlayersByTeam()
    {
        //TODO
    }

}