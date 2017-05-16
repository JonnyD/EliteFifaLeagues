<?php

namespace EliteFifa\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class UserController extends Controller
{
    public function profileAction()
    {
        $userService = $this->get('elite_fifa.user_service');

        $loggedInUser = $userService->getLoggedInUser();
        if (!$loggedInUser) {
            return $this->createNotFoundException('Unable to find user');
        }

        return $this->render('UserBundle:User:profile.html.twig', [
            'loggedInUser' => $loggedInUser
        ]);
    }

    public function showAction($username)
    {
        $userService = $this->get('elite_fifa.user_service');

        $user = $userService->getUserByUsername($username);
        if (!$user) {
            return $this->createNotFoundException('Unable to find user');
        }

        $team = $user->getTeam();

        $matchService = $this->get('elite_fifa.match_service');
        $matches = $matchService->getAllMatchesByTeam($team);

        $teamService = $this->get('elite_fifa.team_service');
        //$form = $teamManager->getFormByTeam($team);
        $form = array();
        return $this->render('TeamBundle:User:show.html.twig', [
            'user' => $user,
            'form' => $form,
            'matches' => $matches
        ]);
    }

    public function selectTeamAction(Request $request)
    {
        $userService = $this->get('elite_fifa.user_service');
        $loggedInUser = $userService->getLoggedInUser();

        $teamService = $this->get('elite_fifa.team_service');

        $teams = $teamService->getTeamsWithoutAManager();
        $teamChoices = [];
        foreach ($teams as $team) {
            $teamChoices[$team->getId()] = $team->getName();
        }

        //todo seperate form into class
        $form = $this->createFormBuilder()
            ->add('teams', 'choice', [
                'choices' => $teamChoices,
            ])
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            $selectedTeam = $teamService->getTeamById($data['teams']);
            $loggedInUser->setTeam($selectedTeam);
            $userService->persist($loggedInUser);
            return $this->redirect($this->generateUrl('task_success'));
        }

        return $this->render('UserBundle:User:selectTeam.html.twig', [
            'teams' => $teams,
            'form' => $form->createView()
        ]);
    }

    public function listAction()
    {
        $userService = $this->get('elite_fifa.user_service');
        $users = $userService->getAllUsers();

        return $this->render('UserBundle:User:list.html.twig', [
            'users' => $users
        ]);
    }
}