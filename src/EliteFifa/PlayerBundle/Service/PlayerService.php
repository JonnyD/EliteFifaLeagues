<?php

namespace EliteFifa\PlayerBundle\Service;

use Doctrine\ORM\EntityManager;
use EliteFifa\UserBundle\Entity\Player;
use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\PlayerBundle\Repository\PlayerRepository;

class PlayerService
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function createPlayer($firstName, $lastName, Team $team)
    {
        $player = new Player();
        $player->setFirstName($firstName);
        $player->setLastName($lastName);
        $player->setTeam($team);
        $this->persistAndFlush($player);
        return $player;
    }

    public function getPlayerByFirstAndLastName($firstName, $lastName)
    {
        return $this->playerRepository->findOneBy(
            array(
                'firstName' => $firstName,
                'lastName' => $lastName
            )
        );
    }

    public function getPlayersByTeam($team)
    {
        return $this->playerRepository->findByTeam($team);
    }
}