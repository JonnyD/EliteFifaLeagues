<?php

namespace EliteFifa\JobBundle\Service;

use EliteFifa\CompetitorBundle\Entity\Competitor;
use EliteFifa\JobBundle\Entity\Job;
use EliteFifa\JobBundle\Repository\JobRepository;

class JobService
{
    /**
     * @var JobRepository
     */
    private $jobRepository;

    /**
     * @param JobRepository $jobRepository
     */
    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    /**
     * @return Job[]
     */
    public function getAllJobs()
    {
        return $this->jobRepository->findAll();
    }

    /**
     * @param int $id
     * @return null|Job
     */
    public function getJobById(int $id)
    {
        return $this->jobRepository->find($id);
    }

    /**
     * @param Competitor $competitor
     */
    public function addJobFromCompetitor(Competitor $competitor)
    {
        $region = $competitor->getSeason()->getRegion();
        $competition = $competitor->getCompetitions()->getMain();

        $job = new Job();
        $job->setCompetitor($competitor);
        $job->setRegion($region);
        $job->setCompetition($competition);

        $this->jobRepository->save($job);
    }

    /**
     * @param Job $job
     */
    public function remove(Job $job)
    {
        $this->jobRepository->remove($job);
    }
}
