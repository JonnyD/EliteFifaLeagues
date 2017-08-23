<?php

namespace EliteFifa\JobBundle\Controller;

use EliteFifa\BaseBundle\Controller\BaseController;
use EliteFifa\JobBundle\Service\JobService;

class JobController extends BaseController
{
    public function listAction()
    {
        $jobService = $this->getJobService();
        $jobs = $jobService->getAllJobs();

        return $this->render('JobBundle:Job:list.html.twig', [
            'jobs' => $jobs
        ]);
    }

    /**
     * @return JobService
     */
    private function getJobService()
    {
        return $this->get('elite_fifa.job_service');
    }
}