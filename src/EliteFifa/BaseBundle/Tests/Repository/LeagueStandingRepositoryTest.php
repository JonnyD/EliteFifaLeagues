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

class LeagueStandingRepositoryTest extends BaseWebTestCase
{
    private $leagueStandingRepository;
    private $leagueRepository;
    private $seasonRepository;
    private $teamRepository;

    public function setUp()
    {
        parent::setUp();

        $this->leagueStandingRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:LeagueStanding');
        $this->leagueRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:League');
        $this->seasonRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Season');
        $this->teamRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Team');
    }

    public function testFindByLeagueAndSeason()
    {
        $league = $this->leagueRepository->findOneByName("Premier League");
        $season = $this->seasonRepository->findCurrentSeasonForLeague($league);

        $standings = $this->leagueStandingRepository->findByLeagueAndSeason($league, $season);
        $this->assertNotNull($standings);
        $this->assertEquals(4, count($standings));
    }

    public function testFindCurrentStandingForTeam()
    {
        $league = $this->leagueRepository->findOneByName("Premier League");
        $season = $this->seasonRepository->findCurrentSeasonForLeague($league);
        $team = $this->teamRepository->findOneByName("Liverpool");

        $standing = $this->leagueStandingRepository->findByTeamLeagueSeason($team, $league, $season);
        $this->assertNotNull($standing);
    }
}