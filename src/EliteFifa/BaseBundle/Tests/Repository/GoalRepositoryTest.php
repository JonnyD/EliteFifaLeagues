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

class GoalRepositoryTest extends BaseWebTestCase
{
    private $leagueRepository;
    private $seasonRepository;
    private $goalRepository;

    public function setUp()
    {
        parent::setUp();

        $this->leagueRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:League');
        $this->seasonRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Season');
        $this->goalRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Goal');
    }

    public function testFindTopGoalScorersByCompetitionAndSeason()
    {
        $competition = $this->leagueRepository->findOneBySlug("league-1");
        $this->assertNotNull($competition);

        $seasons = $this->seasonRepository->findSeasonsByCompetition($competition);
        $this->assertNotNull($seasons);
        $season = $seasons[0];
        $this->assertNotNull($season);

        $goalScorers = $this->goalRepository->findTopGoalScorersByCompetitionAndSeason($competition, $season);
        $this->assertNotNull($goalScorers);
        $this->assertEquals(12, count($goalScorers));
        //TODO
    }
}