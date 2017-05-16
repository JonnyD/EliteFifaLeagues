<?php

namespace EliteFifa\StadiumBundle\Service;

use Doctrine\ORM\EntityManager;
use EliteFifa\StadiumBundle\Entity\Stadium;
use EliteFifa\MatchBundle\Repository\ResultRepository;
use EliteFifa\StadiumBundle\Repository\StadiumRepository;

class StadiumService
{
    private $stadiumRepository;

    public function __construct(StadiumRepository $stadiumRepository)
    {
        $this->stadiumRepository = $stadiumRepository;
    }

    public function createStadium($name)
    {
        $stadium = new Stadium();
        $stadium->setName($name);
        $this->persistAndFlush($stadium);
        return $stadium;
    }

    public function getStadiumBySlug($slug)
    {
        return $this->stadiumRepository->findOneBySlug($slug);
    }

    public function getStadiumByName($name)
    {
        return $this->stadiumRepository->findOneByName($name);
    }
}