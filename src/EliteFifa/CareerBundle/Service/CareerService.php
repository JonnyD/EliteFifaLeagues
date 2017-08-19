<?php

namespace EliteFifa\CareerBundle\Service;

use EliteFifa\CareerBundle\Criteria\CareerCriteria;
use EliteFifa\CareerBundle\Entity\Career;
use EliteFifa\CareerBundle\Repository\CareerRepository;
use EliteFifa\UserBundle\Entity\User;

class CareerService
{
    /**
     * @var CareerRepository
     */
    private $careerRepository;

    /**
     * @param CareerRepository $careerRepository
     */
    public function __construct(CareerRepository $careerRepository)
    {
        $this->careerRepository = $careerRepository;
    }

    /**
     * @param User $user
     * @return Career[]
     */
    public function getCareersByUser(User $user)
    {
        $criteria = new CareerCriteria();
        $criteria->setUser($user);

        $careers = $this->careerRepository->findCareersByCriteria($criteria);
        return $careers;
    }
}