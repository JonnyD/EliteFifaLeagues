<?php

namespace EliteFifa\Bundle\Controller;

use EliteFifa\Bundle\Form\SelectSeasonForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function showAction()
    {
        $leagueManager = $this->container->get("elite_fifa.league_manager");
        $seasonManager = $this->container->get("elite_fifa.season_manager");
        $participantManager = $this->container->get("elite_fifa.participant_manager");
        $matchManager = $this->container->get("elite_fifa.match_manager");

        $league1 = $leagueManager->getLeagueByName("League 1");
        $worldSeason1 = $seasonManager->getSeasonByCompetitionAndNumber($league1, 1);
        $participants = $participantManager->getParticipantsByCompetitionAndSeason($league1, $worldSeason1);
        $fixtures = $matchManager->createFixtures($participants, $worldSeason1, $league1);
        var_dump($fixtures);
        //$matchManager->persist($fixtures);

        return $this->render('EliteFifaBundle:Default:index.html.twig', array(

        ));
    }
}