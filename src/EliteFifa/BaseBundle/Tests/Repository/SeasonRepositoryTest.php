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
use EliteFifa\Bundle\Entity\Season;

class SeasonRepositoryTest extends BaseWebTestCase
{
    private $seasonRepository;
    private $leagueRepository;

    public function setUp()
    {
        parent::setUp();

        $this->seasonRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Season');
        $this->leagueRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:League');
    }

    public function testFindNumbersByLeague()
    {
        $league = $this->leagueRepository->findOneByName("Premier League");

        $numbers = $this->seasonRepository->findNumbersByLeague($league);
        $this->assertNotNull($numbers);
        $this->assertEquals(2, $numbers);
    }

    public function testFindCurrentSeasonForCompetition()
    {
        //TODO
    }

    public function testFindSeasonsByCompetition()
    {
        //TODO
    }

    public function testFindSeasonForCompetitionByNumber()
    {
        //TODO
    }
}