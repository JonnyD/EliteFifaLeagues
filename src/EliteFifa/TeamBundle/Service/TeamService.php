<?php

namespace EliteFifa\TeamBundle\Service;

use EliteFifa\StadiumBundle\Entity\Stadium;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\UserBundle\Entity\User;
use EliteFifa\MatchBundle\Manager\MatchManager;
use EliteFifa\TeamBundle\Repository\TeamRepository;
use Doctrine\ORM\EntityManager;

class TeamService
{
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function createTeam($name, $rating, User $user)
    {
        $team = new Team();
        $team->setName($name);
        $team->setRating($rating);
        $team->setUser($user);
        $this->persistAndFlush($team);
        return $team;
    }

    /**
     * @return Team[]
     */
    public function getAllTeams()
    {
        return $this->teamRepository->findAll();
    }

    public function getTeamById($id)
    {
        return $this->teamRepository->findOneById($id);
    }

    public function getTeamByName($name)
    {
        return $this->teamRepository->findOneByName($name);
    }

    public function getTeamBySlug($slug)
    {
        return $this->teamRepository->findOneBySlug($slug);
    }

    public function getTeamsWithoutAManager()
    {
        return $this->teamRepository->findTeamsWithoutAManager();
    }
}