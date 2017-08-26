<?php

namespace EliteFifa\JobBundle\Controller;

use EliteFifa\BaseBundle\Controller\BaseController;
use EliteFifa\JobBundle\Entity\JobApplication;
use EliteFifa\JobBundle\Form\JobApplicationType;
use EliteFifa\JobBundle\Service\JobApplicationService;
use EliteFifa\JobBundle\Service\JobService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function applyAction(Request $request, int $id)
    {
        $jobService = $this->getJobService();
        $job = $jobService->getJobById($id);

        $jobApplication = new JobApplication();
        $jobApplication->setJob($job);
        $jobApplication->setUser($this->getLoggedInUser());

        $form = $this->createForm(JobApplicationType::class, $jobApplication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobApplicationService = $this->getJobApplicationService();
            $jobApplicationService->save($jobApplication);
        }

        return $this->render('JobBundle:Job:apply.html.twig', [
            'job' => $job,
            'form' => $form->createView()
        ]);
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