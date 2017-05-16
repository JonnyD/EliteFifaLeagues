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

class MatchRepositoryTest extends BaseWebTestCase
{
    private $matchRepository;
    private $teamRepository;
    private $userRepository;

    public function setUp()
    {
        parent::setUp();

        $this->matchRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Match');
        $this->teamRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:Team');
        $this->userRepository = $this->getEntityManager()->getRepository('EliteFifaBundle:User');
    }

    public function testFindAll()
    {
        $matches = $this->matchRepository->findAll();
        $this->assertNotNull($matches);
        $this->assertTrue(is_array($matches));
        $this->assertEquals(24, count($matches));
    }

    public function testFindOneById()
    {
        $match = $this->matchRepository->find(1);
        $this->assertNotNull($match);

        $homeTeam = $match->getHomeTeam();
        $this->assertNotNull($homeTeam);
        $this->assertEquals("Liverpool", $homeTeam->getName());

        $awayTeam = $match->getAwayTeam();
        $this->assertNotNull($awayTeam);
        $this->assertEquals("Chelsea", $awayTeam->getName());
    }

    public function testFindByUser()
    {
        $user = $this->userRepository->findOneByUsername("user1");

        $matches = $this->matchRepository->findMatchesByUser($user);
        $this->assertNotNull($matches);
        $this->assertEquals(12, count($matches));
    }

    public function testFindAllByTeam()
    {
        $team = $this->teamRepository->findByName("Liverpool");

        $matches = $this->matchRepository->findMatchesByTeam($team);
        $this->assertNotNull($matches);
        $this->assertEquals(12, count($matches));
    }

    public function testFindAllPlayed()
    {
        $matches = $this->matchRepository->findMatchesPlayed();

        $this->assertEquals(23, count($matches));
    }

    public function testFindLast5MatchesPlayed()
    {
        $team = $this->teamRepository->findByName("Liverpool");

        $matches = $this->matchRepository->findLast5MatchesPlayed($team);
        $this->assertNotNull($matches);
        $this->assertEquals(12, count($matches));
    }

    public function testFindMatchesForCompetitionBySeason()
    {
        //TODO
    }

    public function testFindMatchesForCompetitionBySeasonAndRound()
    {
        //TODO
    }
}