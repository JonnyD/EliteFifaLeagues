<?php

namespace EliteFifa\CompetitorBundle\Form;

use EliteFifa\CompetitionBundle\Entity\Competition;
use EliteFifa\MatchBundle\Entity\Round;
use EliteFifa\SeasonBundle\Entity\Season;
use EliteFifa\TeamBundle\Service\TeamService;
use EliteFifa\UserBundle\Service\UserService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ChangeCompetitorForm extends AbstractType
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var TeamService
     */
    private $teamService;

    /**
     * @param UserService $userService
     * @param TeamService $teamService
     */
    public function __construct(UserService $userService, TeamService $teamService)
    {
        $this->userService = $userService;
        $this->teamService = $teamService;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', 'choice', [
                'choices' => $this->userService->getAllUsers(),
                'label' => 'User'
            ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'change_competitor';
    }
}