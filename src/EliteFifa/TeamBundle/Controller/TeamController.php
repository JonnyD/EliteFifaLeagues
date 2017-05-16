<?php

namespace EliteFifa\TeamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class TeamController extends Controller
{
    public function listAction()
    {
        $teamService = $this->get('elite_fifa.team_service');

        $teams = $teamService->getAllTeams();
        if (!$teams) {
            throw $this->createNotFoundException('Unable to find teams');
        }

        return $this->render('EliteFifaBundle:Team:list.html.twig', [
            'teams' => $teams
        ]);
    }

    public function showAction($slug)
    {
        $teamService = $this->get('elite_fifa.team_service');

        $team = $teamService->getTeamBySlug($slug);
        if (!$team) {
            throw $this->createNotFoundException('Unable to find team');
        }

        $matchManager = $this->get('elite_fifa.match_manager');
        $matches = $matchManager->getAllMatchesByTeam($team);

        return $this->render('EliteFifaBundle:Team:show.html.twig', [
            'team' => $team,
            'matches' => $matches
        ]);
    }
}