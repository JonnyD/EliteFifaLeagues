<?php

namespace EliteFifa\MatchBundle\Twig;

use EliteFifa\TeamBundle\Entity\Team;
use EliteFifa\MatchBundle\Service\MatchService;

class RecentFormExtension extends \Twig_Extension
{
    /**
     * @var MatchService $matchService
     */
    private $matchService;

    /**
     * @param MatchService $matchService
     */
    public function __construct(MatchService $matchService)
    {
        $this->matchService = $matchService;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'recentForm' => new \Twig_Function_Method($this, 'recentForm')
        );
    }

    /**
     * @param Team $team
     * @return array
     */
    public function recentForm(Team $team = null)
    {
        $recentForm = $this->matchService->getFormByTeam($team);
        return $recentForm;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'recentFormExtension';
    }
}