<?php

namespace EliteFifa\CareerBundle\Service;

use EliteFifa\CareerBundle\Criteria\CareerCriteria;
use EliteFifa\CareerBundle\Entity\Career;
use EliteFifa\CareerBundle\Repository\CareerRepository;
use EliteFifa\JobBundle\Entity\JobApplication;
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

    /**
     * @param JobApplication $jobApplication
     */
    public function updateCareerByJobApplication(JobApplication $jobApplication)
    {
        $user = $jobApplication->getUser();
        $region = $jobApplication->getJob()->getRegion();
        $competitor = $jobApplication->getJob()->getCompetitor();

        $criteria = new CareerCriteria();
        $criteria->setUser($user);
        $criteria->setRegion($region);

        $career = $this->careerRepository->findCareerByCriteria($criteria);
        if ($career != null) {
            $career->setCompetitor($competitor);
        } else {
            $career = new Career();
            $career->setCompetitor($competitor);
            $career->setRegion($region);
            $career->setUser($user);
        }

        $this->save($career);
    }

    /**
     * @param Career $career
     */
    public function save(Career $career)
    {
        $this->careerRepository->save($career);
    }
}