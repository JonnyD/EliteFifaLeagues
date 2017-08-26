<?php

namespace EliteFifa\JobBundle\Controller;

use EliteFifa\BaseBundle\Controller\BaseController;
use EliteFifa\JobBundle\Service\JobApplicationService;
use EliteFifa\JobBundle\Service\JobService;

class AdminJobApplicationController extends BaseController
{
    /**
     * @param int $id
     */
    public function acceptAction(int $id)
    {
        $jobApplicationService = $this->getJobApplicationService();
        $jobApplication = $jobApplicationService->getJobApplicationById($id);

        $jobApplicationService->accept($jobApplication);

        $jobService = $this->getJobService();
        $jobService->remove($jobApplication->getJob());
    }

    /**
     * @return JobService
     */
    private function getJobService()
    {
        return $this->get('elite_fifa.job_service');
    }

    /**
     * @return JobApplicationService
     */
    private function getJobApplicationService()
    {
        return $this->get('elite_fifa.job_application_service');
    }
}