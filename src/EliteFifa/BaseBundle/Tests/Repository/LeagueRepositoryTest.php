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
use EliteFifa\Bundle\Entity\Match;
use EliteFifa\Bundle\Entity\Team;
use EliteFifa\Bundle\Entity\User;

class LeagueRepositoryTest extends BaseWebTestCase
{
    private $leagueRepository;

    public function setUp()
    {
        parent::setUp();

        $this->leagueRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:League');
    }

    public function testFindAll()
    {
        $leagues = $this->leagueRepository->findAll();

        $this->assertNotNull($leagues);
        $this->assertEquals(2, count($leagues));
    }

    public function testFindOneByName()
    {
        $league = $this->leagueRepository->findOneByName("EFL Ladder");

        $this->assertNotNull($league);
        $this->assertEquals("EFL Ladder", $league->getName());
    }

    public function testFindOneBySlug()
    {
        $league = $this->leagueRepository->findOneBySlug("league-1");
        $this->assertNotNull($league);
        $this->assertEquals("League 1", $league->getName());
    }
}