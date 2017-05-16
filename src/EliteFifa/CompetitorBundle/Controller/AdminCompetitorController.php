<?php

namespace EliteFifa\CompetitorBundle\Controller;

use EliteFifa\CompetitorBundle\Service\CompetitorService;
use EliteFifa\TeamBundle\Service\TeamService;
use EliteFifa\UserBundle\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class AdminCompetitorController extends Controller
{
    public function changeAction(Request $request, $id)
    {
        $competitor = $this->getCompetitorService()->getCompetitorById($id);

        $users = $this->getUserService()->getAllUsers();
        $teams = $this->getTeamService()->getAllTeams();

        $userChoices = [];
        foreach ($users as $user) {
            $userChoices[$user->getUsername()] = $user->getId();
        }

        $teamChoices = [];
        foreach ($teams as $team) {
            $teamChoices[$team->getName()] = $team->getId();
        }

        $form = $this->createFormBuilder()
            ->add('user', ChoiceType::class, [
                'choices' => $userChoices,
                'label' => 'User'
            ])
            ->add('team', ChoiceType::class, [
                'choices' => $teamChoices,
                'label' => 'Team'
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = $this->getUserService()->getUserById($data['user']);
            $team = $this->getTeamService()->getTeamById($data['team']);

            $competitor->setUser($user);
            $competitor->setTeam($team);
            $this->getCompetitorService()->save($competitor);
        }

        return $this->render('CompetitorBundle:AdminCompetitor:change.html.twig', [
            'competitor' => $competitor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return CompetitorService
     */
    private function getCompetitorService()
    {
        return $this->get('elite_fifa.competitor_service');
    }

    /**
     * @return UserService
     */
    private function getUserService()
    {
        return $this->get('elite_fifa.user_service');
    }

    /**
     * @return TeamService
     */
    private function getTeamService()
    {
        return $this->get('elite_fifa.team_service');
    }
}