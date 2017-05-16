<?php

namespace EliteFifa\UserBundle\Controller;

use EliteFifa\SeasonBundle\Form\SelectSeasonForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class OfficeController extends Controller
{
    public function showAction()
    {
        $userService = $this->get('elite_fifa.user_service');
        $loggedInUser = $userService->getLoggedInUser();
        $team = $loggedInUser->getTeam();

        $matchService = $this->get('elite_fifa.match_service');
        $matches = $matchService->getMatchesByUser($loggedInUser);

        $results = $matchService->getResultsByUser($loggedInUser);

        $teamService = $this->get('elite_fifa.team_service');
        //$form = $teamManager->getFormByTeam($team);
        $form = array();

        return $this->render('UserBundle:User:office.html.twig', [
            'user' => $loggedInUser,
            'matches' => $matches,
            'results' => $results,
            'form' => $form,
        ]);
    }
}