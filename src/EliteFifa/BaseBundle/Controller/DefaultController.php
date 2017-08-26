<?php

namespace EliteFifa\BaseBundle\Controller;

use EliteFifa\Bundle\Form\SelectSeasonForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    public function showAction()
    {
        $fixtures = [];

        $teams = ['Liverpool', 'Man Utd', 'Arsenal', 'Chelsea', 'Leicester', 'Everton'];

        $rounds = count($teams) - 1;
        $away = array_splice($teams,(count($teams)/2));
        $home = $teams;
        for ($i=0; $i < $rounds; $i++){
            for ($j=0; $j<count($home); $j++){
                $round[$i][$j]["Home"]=$home[$j];
                $round[$i][$j]["Away"]=$away[$j];
            }
            if(count($home)+count($away)-1 > 2){
                array_unshift($away, current(array_splice($home,1,1)) );
                array_push($home,array_pop($away));
            }
        }

        $roundNumber = count($round);
        foreach ($round as $r => $m) {
            foreach ($m as $j => $match) {
                $round[$roundNumber][$j]['Home'] = $match['Away'];
                $round[$roundNumber][$j]['Away'] = $match['Home'];
            }

            $roundNumber++;
        }


        print_r($round);

        return $this->render('BaseBundle:Default:index.html.twig', array(

        ));
    }
}