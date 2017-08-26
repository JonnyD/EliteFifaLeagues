<?php

namespace EliteFifa\JobBundle\Controller;

use EliteFifa\BaseBundle\Controller\BaseController;
use EliteFifa\JobBundle\Service\JobService;
use Symfony\Component\HttpFoundation\Response;

class AdminJobController extends BaseController
{
    /**
     * @return Response
     */
    public function listAction()
    {
        $jobService = $this->getJobService();
        $jobs = $jobService->getAllJobs();

        return $this->render('JobBundle:AdminJob:list.html.twig', [
            'jobs' => $jobs
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function showAction(int $id)
    {
        $jobService = $this->getJobService();
        $job = $jobService->getJobById($id);

        return $this->render('JobBundle:AdminJob:show.html.twig', [
            'job' => $job
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